<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqSection;
use App\Models\Faq;


class FaqSectionController extends Controller
{
    public function FaqSectionIndex(){
        $faqSection=FaqSection::first();
         $faq=Faq::all();
        return view('admin.faqSection.index',compact('faqSection','faq'));
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

     public function FaqQuestionAnswerStore(Request $request){
         $request->validate([
        'question' => 'required|string|max:255',
        'answer'   => 'required|string',
        'status'   => 'required|boolean',
        'order'    => 'required|integer|unique:faqs,order',
    ]);

    Faq::create([
        'question' => $request->question,
        'answer'   => $request->answer,
        'status'   => $request->status,
        'order'    => $request->order,
    ]);
        $notification = array(
            'message' => 'FAQ create successfully!.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function FaqQuestionAnswerView($id){
       $faq=Faq::findOrFail($id);
       return view('admin.faqSection.details',compact('faq'));
    }

    public function FaqQuestionAnswerUpdate(Request $request ,$id){
            $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'status'   => 'required|boolean',
            'order'    => 'required|integer|unique:faqs,order,' . $id,
        ]);

        Faq::where('id', $id)->update([
            'question' => $request->question,
            'answer'   => $request->answer,
            'status'   => $request->status,
            'order'    => $request->order,
        ]);

        $notification = array(
            'message' => 'FAQ updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function FaqQuestionAnswerDestroy($id){
       $faq=Faq::findOrFail($id);
       $faq->delete();

        $notification = array(
            'message' => 'Faq question answer deleted successfully!',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }

    public function toggleFaqQuestionAnswer($id){
        $faq=Faq::findOrFail($id);
        $faq->status = !$faq->status;
        $faq->save();
        $notification = array(
            'message' => 'Status updated.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
