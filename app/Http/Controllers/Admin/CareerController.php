<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
class CareerController extends Controller
{
    public function CareerCreate(){
        $career=Career::first();
        return view('admin.career.create',compact('career'));
    }
    public function CareerUpdate(Request $request, $id){
    $request->validate([
        'title' => 'required|string|max:255',
        'short_description' => 'nullable|string',
        'details_description' => 'nullable|string',
        'button_text' => 'nullable|string|max:255',
        'button_link' => 'nullable|url',
        'status' => 'nullable|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $partnership = Career::findOrFail($id);

    $data = [
        'title' => $request->title,
        'short_description' => $request->short_description,
        'details_description' => $request->details_description,
        'button_text' => $request->button_text,
        'button_link' => $request->button_link,
        'status' => $request->status ?? $partnership->status,
    ];

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $uploadPath = public_path('upload/careers');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $image->move($uploadPath, $imageName);
        $data['image'] = $imageName;

        // Old image delete
        if ($partnership->image && file_exists(public_path('upload/careers/' . $partnership->image))) {
            unlink(public_path('upload/careers/' . $partnership->image));
        }
    }

        $partnership->update($data);
         $notification=array(
            'message'=>'Career updated successfully!',
            'alert-type'=>'success'
            );
    return back()->with($notification);
 }



}
