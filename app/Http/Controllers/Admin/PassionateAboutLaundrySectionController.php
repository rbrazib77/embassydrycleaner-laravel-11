<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PassionateAboutLaundrySection;


class PassionateAboutLaundrySectionController extends Controller
{
    public function PassionateAboutLaundryCreate(){
          $passionateAboutLaundrySection=PassionateAboutLaundrySection::first();
        return view('admin.passionateLaundrySection.update',compact('passionateAboutLaundrySection'));
    }

     public function PassionateAboutLaundryUpdate(Request $request,$id){
        $request->validate([
        'heading' => 'required|string|max:255',
        'content' => 'required|string',
        'status'  => 'required|boolean',
    ]);

        PassionateAboutLaundrySection::where('id', $id)->update([
            'heading' => $request->heading,
            'content' => $request->content,
            'status'  => $request->status,
        ]);

        $notification = array(
            'message' => 'Passionate about laundry update.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    


}
