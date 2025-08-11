<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurServiceSection;



class OurServiceSectionController extends Controller
{
    public function OurServiceIndex(){
        $service=OurServiceSection::all();
        return view('admin.ourServiceSection.index',compact('service'));
    }

    public function OurServiceCreate(){
        return view('admin.ourServiceSection.create');
    }

    public function OurServiceStore(Request $request){
        $request->validate([
        'title'       => 'required|string|max:255',
        'description'    => 'required|string|max:500',
        'status'      => 'required|boolean',
        'order' => 'required|integer|unique:our_service_sections,order',
        'icon'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->only('title', 'description', 'status', 'order');

    if ($request->hasFile('icon')) {
        $icon = $request->file('icon');
        $iconName = time() . '.' . $icon->getClientOriginalExtension();
        $icon->move(public_path('upload/services'), $iconName);
        $data['icon'] = $iconName;
    }

    OurServiceSection::create($data);
     $notification=array(
            'message'=>'Service created successfully!',
            'alert-type'=>'success'
         );
          return redirect()->route('admin.service.index')->with($notification);
    }


     public function OurServiceUpdate(Request $request, $id){
        $service = OurServiceSection::findOrFail($id);
        $request->validate([
            'title'       => 'required|string|max:255',
            'description'    => 'required|string|max:500',
            'status'      => 'required|boolean',
            'order'       => 'required|integer|unique:our_service_sections,order,' . $service->id,
            'icon'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'description', 'status', 'order');

        if ($request->hasFile('icon')) {
            if ($service->icon && file_exists(public_path('upload/services/' . $service->icon))) {
                unlink(public_path('upload/services/' . $service->icon));
            }

            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('upload/services'), $iconName);
            $data['icon'] = $iconName;
        }
        $service->update($data);
        $notification = array(
            'message' => 'Service updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function OurServiceDetails($id){
        $service=OurServiceSection::findOrFail($id);
        return view('admin.ourServiceSection.details',compact('service'));
    }

     public function OurServiceDelete($id){
        $service = OurServiceSection::findOrFail($id);
        if ($service->icon && file_exists(public_path('upload/services/' . $service->icon))) {
            unlink(public_path('upload/services/' . $service->icon));
        }
        $service->delete();

        $notification = array(
            'message' => 'Service deleted successfully!',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }
    public function toggleOurService($id){
        $service = OurServiceSection::findOrFail($id);
        $service->status = !$service->status;
        $service->save();
        $notification = array(
            'message' => 'Status updated.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }





    
}
