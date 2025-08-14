<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaLink;

class SocialMediaLinkController extends Controller
{
    public function SocialMediaLinkIndex(){
        $socialMediaLink=SocialMediaLink::all();
        return view('admin.socialMediaLink.index',compact('socialMediaLink'));
    }
    public function SocialMediaLinkCreate(){
            return view('admin.socialMediaLink.create');
    }

     public function SocialMediaLinkStore(Request $request){
             $request->validate([
                'platform'    => 'required|string|max:255',
                'icon_class'  => 'required|string|max:255',
                'url'         => 'required|url',
                'status'      => 'required|boolean',
                'order' => 'required|integer|unique:social_media_links,order',
            ]);
                SocialMediaLink::create([
                'platform'   => $request->platform,
                'icon_class' => $request->icon_class,
                'url'        => $request->url,
                'status'     => $request->status,
                'order'      => $request->order ?? 0,
                ]);

            $notification=array(
            'message'=>'Social media link create',
            'alert-type'=>'success'
         );
          return redirect()->back()->with($notification);

    }

    public function SocialMediaLinkUpdate(Request $request, $id){
    $request->validate([
        'platform'    => 'required|string|max:255',
        'icon_class'  => 'required|string|max:255',
        'url'         => 'required|url',
        'status'      => 'required|boolean',
        'order'       => 'required|integer|unique:social_media_links,order,' . $id,
    ]);

    $socialLink = SocialMediaLink::findOrFail($id);

    $socialLink->update([
        'platform'   => $request->platform,
        'icon_class' => $request->icon_class,
        'url'        => $request->url,
        'status'     => $request->status,
        'order'      => $request->order ?? 0,
    ]);

    $notification = [
        'message'    => 'Social media link updated successfully',
        'alert-type' => 'success'
    ];

    return redirect()->back()->with($notification);
}




    public function SocialMediaLinkDelete($id){
        $socialMediaLink = SocialMediaLink::findOrFail($id);
        $socialMediaLink->delete();

        $notification = array(
            'message' => 'Social media link deleted successfully!',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }

    public function toggleSocialMediaLink($id){
        $socialMediaLink = SocialMediaLink::findOrFail($id);
        $socialMediaLink->status = !$socialMediaLink->status;
        $socialMediaLink->save();
        $notification = array(
            'message' => 'Status updated.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    
    


}
