<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use File;
class SettingController extends Controller
{
    public function WebsiteIndex(){
        $websiteSetting= WebsiteSetting::first();
        return view('admin.websiteSetting.index',compact('websiteSetting'));
    }

    public function WebsiteUpdate(Request $request ,$id){
        $request->validate([
            'company_name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fav_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'footer_description' => 'required|string',
            'copy_right' => 'nullable|string|max:255',
            'working_time' => 'nullable|string|max:255',
            
        ]);

        $websiteSetting = WebsiteSetting::findOrFail($id);
        $websiteSetting->phone = $request->phone;
        $websiteSetting->email = $request->email;
        $websiteSetting->company_name = $request->company_name;
        $websiteSetting->address = $request->address;
        $websiteSetting->copy_right = $request->copy_right;
        $websiteSetting->working_time = $request->working_time;
        $websiteSetting->footer_description = $request->footer_description;
       
        if ($request->hasFile('logo')) {
            $oldImagePath=public_path('upload/settings/'.$websiteSetting->logo);

            if($websiteSetting->logo && File::exists($oldImagePath) ){
                File::delete($oldImagePath);
            }

            $filename = time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $distinationPath=public_path('upload/settings/');

                if(!File::exists($distinationPath)){
                    File::makeDirectory($distinationPath,0775,true);
                }

            if($request->file('logo')->move($distinationPath, $filename)){
                $websiteSetting->logo=$filename;
            }else{
                return response()->json(['error' => 'Failed to upload image.'], 500);
            }
        }

        
        if ($request->hasFile('fav_icon')) {
            $oldImagePath=public_path('upload/settings/'.$websiteSetting->fav_icon);

            if($websiteSetting->fav_icon && File::exists($oldImagePath) ){
                File::delete($oldImagePath);
            }

            $filename = time() . '.' . $request->file('fav_icon')->getClientOriginalExtension();
            $distinationPath=public_path('upload/settings/');

                if(!File::exists($distinationPath)){
                    File::makeDirectory($distinationPath,0775,true);
                }

            if($request->file('fav_icon')->move($distinationPath, $filename)){
                $websiteSetting->fav_icon=$filename;
            }else{
                return response()->json(['error' => 'Failed to upload image.'], 500);
            }
        }
        
        $websiteSetting->save();

        $notification=array(
            'message'=>'Website setting Update!',
            'alert-type'=>'success'
         );
          return redirect()->back()->with($notification);
    }



   
}
