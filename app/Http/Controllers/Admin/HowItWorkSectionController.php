<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HowItWork;
class HowItWorkSectionController extends Controller
{
    public function HowItWorksIndex(){
       $howItwork= HowItWork::all();
        return view('admin.howItWorksSection.index',compact('howItwork'));
    }
     public function HowItWorksCreate(){
        return view('admin.howItWorksSection.create');
    }

     public function HowItWorksStore(Request $request){
         $request->validate([
        'title'       => 'required|string|max:20',
        'description'    => 'required|string|max:70',
        'status'      => 'required|boolean',
        'order' => 'required|integer|unique:how_it_works,order',
        'icon'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->only('title', 'description', 'status', 'order');

    if ($request->hasFile('icon')) {
        $icon = $request->file('icon');
        $iconName = time() . '.' . $icon->getClientOriginalExtension();
        $icon->move(public_path('upload/how_it_works'), $iconName);
        $data['icon'] = $iconName;
    }

    HowItWork::create($data);
     $notification=array(
            'message'=>'How it work created successfully!',
            'alert-type'=>'success'
         );
          return redirect()->route('admin.how.it.works.index')->with($notification);
    }

    public function HowItWorksUpdate(Request $request, $id){
        $howItwork = HowItWork::findOrFail($id);
        $request->validate([
            'title'       => 'required|string|max:20',
            'description'    => 'required|string|max:55',
            'status'      => 'required|boolean',
            'order'       => 'required|integer|unique:how_it_works,order,' . $howItwork->id,
            'icon'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'description', 'status', 'order');

        if ($request->hasFile('icon')) {
            if ($howItwork->icon && file_exists(public_path('upload/how_it_works/' . $howItwork->icon))) {
                unlink(public_path('upload/how_it_works/' . $howItwork->icon));
            }

            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('upload/how_it_works'), $iconName);
            $data['icon'] = $iconName;
        }
        $howItwork->update($data);
        $notification = array(
            'message' => 'Service updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }




    public function HowItWorksDelete($id){
        $howItwork = HowItWork::findOrFail($id);
         if ($howItwork->icon && file_exists(public_path('upload/how_it_works/' . $howItwork->icon))) {
            unlink(public_path('upload/how_it_works/' . $howItwork->icon));
        }
        $howItwork->delete();

        $notification = array(
            'message' => 'How it work deleted successfully!',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }


     public function toggleHowItWorks($id){
        $howItwork = HowItWork::findOrFail($id);
        $howItwork->status = !$howItwork->status;
        $howItwork->save();
        $notification = array(
            'message' => 'Status updated.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }




}
