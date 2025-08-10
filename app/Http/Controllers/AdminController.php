<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAdminMail;

class AdminController extends Controller
{
     public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function AdminProfile(){
        $id=Auth::user()->id;
        $profileData=User::find($id);
        return view('admin.profile.index',compact('profileData'));
    }
   public function  ProfileStore(Request $request){
        $id=Auth::user()->id;
        $data=User::find($id);

        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;
       
        $oldPhotoPath=$data->photo;

        if($request->hasFile('photo')){
            $file=$request->file('photo');
            $fileName=time().'.'. $file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'),$fileName);
            $data->photo=$fileName;

            if($oldPhotoPath && $oldPhotoPath !== $fileName){
                $this->deleteOldImage($oldPhotoPath);
            }
        }
        $data->save();
        $notification=array(
            'message'=>'Profile Update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    protected function deleteOldImage($filename){
        $fullPath = public_path('upload/user_images/' . $filename);

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }


    public function AdminPasswordUpdate(Request $request){
        $user=Auth::user();
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required|confirmed',
        ]);

        if(!Hash::check($request->old_password, $user->password)){
             $notification=array(
            'message'=>'Old Password does not Match!',
            'alert-type'=>'error'
        );
         return back()->with($notification);
        }

        User::whereId($user->id)->update([
            'password'=>Hash::make($request->new_password),
        ]);

        Auth::logout();

         $notification=array(
            'message'=>'Password Update Successfully!',
            'alert-type'=>'success'
         );
          return redirect()->route('login')->with($notification);
    }

    public function UserList(){
        $user=User::all();
        return view('admin.user.index',compact('user'));
    }

    public function NewUser(){
        return view('admin.user.new_user_create');
    }

    
    public function NewUserCreate(Request $request){
         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);
        $random_password=Str::upper(Str::random(6));
        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'email_verified_at'=>Carbon::now(),
            'password'=>bcrypt($random_password),
             'created_at'=>Carbon::now(),
            'role'=>"admin",
        ]);
        // NewAdminMail
         Mail::to($request->email)->send(new NewAdminMail(  auth()->user()->name,$request->email,$random_password));
         $notification=array(
            'message'=>'New user create successfully!',
            'alert-type'=>'success'
         );
          return back()->with($notification);
    }

    public function destroy($id){
        if (auth()->id() == $id) {
            $notification = [
                'message' => 'You cannot delete your own account while logged in!',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }

        $delete = User::findOrFail($id);
        $delete->delete();

        $notification = [
            'message' => 'User deleted successfully!',
            'alert-type' => 'warning'
        ];
        return back()->with($notification);
    }





   
}
