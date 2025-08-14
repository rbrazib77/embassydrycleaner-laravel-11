<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqSection;

class FaqSectionController extends Controller
{
    public function FaqSectionIndex(){
        $faqSection=FaqSection::first();
        return view('admin.faqSection.index',compact('faqSection'));
    }

    public function FaqSectionUpdate(Request $request,$id){
        $request->validate([
        'heading' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,avif|max:2048',
        'status' => 'required|boolean',
    ]);

    $faqSection = FaqSection::findOrFail($id);

    $data = [
        'heading' => $request->heading,
        'status'  => $request->status,
    ];

    if ($request->hasFile('image')) {
        $filename = time().'.'.$request->image->extension();
        $request->image->move(public_path('upload/faq'), $filename);
        $data['image'] = $filename;
    }

    $faqSection->update($data);
     $notification = array(
            'message' => 'Passionate about laundry update.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }


}
