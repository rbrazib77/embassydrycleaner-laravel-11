<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partnership;

class PartnershipController extends Controller
{
    public function PartnershipCreate(){
      $partnership = Partnership::first();
      $points = $partnership ? $partnership->points : [];
     return view('admin.partnership.create',compact('points','partnership'));
    }
   
    public function PartnershipStore(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'points' => 'nullable|array',
            'details_description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $partnership = Partnership::first();

        $data = [
            'title' => $request->title,
            'short_description' => $request->short_description,
            'details_description' => $request->details_description,
            'status' => $request->status ?? 0,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
        ];

        $submittedPoints = collect($request->points ?? [])->filter(function($p) {
            return !is_null($p) && trim($p) !== '';
        })->values()->toArray();

        $data['points'] = $submittedPoints;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $uploadPath = public_path('upload/partnerships');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $image->move($uploadPath, $imageName);
            $data['image'] = $imageName;

            // Old image delete
            if ($partnership && $partnership->image) {
                $oldImagePath = public_path('upload/partnerships/' . $partnership->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
        // Create or Update
        if (!$partnership) {
            Partnership::create($data);
        } else {
            $partnership->update($data);
        }

        $notification=array(
            'message'=>'Partnership updated successfully!',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }









}
