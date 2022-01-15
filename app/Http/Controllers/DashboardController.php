<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    private $user ;
    private $userRoute ;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $this->user = $user;
            $userRoles = $user->roles;
            $userRoute = [];
            foreach ($user->roles as $role){
                foreach ($role->roleRoutes as $routes){
                    array_push($userRoute, $routes->route_name);
                }
            }
            $this->userRoute = $userRoute;
            $request->merge(compact('userRoute'));
            if (Auth::user()->type === 1){
                return $next($request);
            } elseif (Auth::user()->status == 1){
                return $next($request);
            }
            return redirect()->route('/')->send();
        });
    }

    public function index(){
        return view('backend.dashboard.dashboard');
    }
    public function personalInformation(){
        $user = Auth::user();
        $personalInformation = UserInformation::get();
        if ($personalInformation->count() > 0) {
            $personalInformation = UserInformation::where('user_id', $user->id)->first();
            return view('backend.dashboard.edit-personal-information', compact('personalInformation'));
        }else {
            return view('backend.dashboard.personal-information');
        }
    }
    public function personalInformationUpdate(Request $request){
        $user = Auth::user();
        $personalInformation = UserInformation::get();
        if ($personalInformation->count() > 0) {
            $personalInformation = UserInformation::where('user_id', $user->id)->first();
            $this->savePersonalInformation($personalInformation, $request);
            $personalInformation->save();
            return redirect(route('dashboard'))->with('message', 'Personal Information Update Successfully');
        }else{
            $personalInformation = new UserInformation();
            $personalInformation->user_id     = $user->id;
            $this->savePersonalInformation($personalInformation, $request);
            $personalInformation->save();
            return redirect(route('dashboard'))->with('message', 'Personal Information Stored Successfully');
        }
    }
    public function changePasswordForm(){
        return view('backend.dashboard.change-password');
    }
    public function changePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('message', 'Current password does not match!');
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('message', 'Password successfully changed!');
    }
    private function savePersonalInformation($personalInformation, $request){
        $image  = $request->file('image');
        if ($image) {
            if ($personalInformation->image) {
                if (file_exists($personalInformation->image)) {
                    unlink($personalInformation->image);
                }
            }
            $personalInformation->image = $this->imageUpload($image, $this->profileImageDirectory());
        }
        $personalInformation->father_name           =   $request->father_name;
        $personalInformation->mother_name           =   $request->mother_name;
        $personalInformation->dob                   =   $request->dob;
        $personalInformation->gender                =   $request->gender;
        $personalInformation->religion              =   $request->religion;
        $personalInformation->marital_status        =   $request->marital_status;
        $personalInformation->nationality           =   $request->nationality;
        $personalInformation->national_id           =   $request->national_id;
        $personalInformation->passport_number       =   $request->passport_number;
        $personalInformation->passport_issue_date   =   $request->passport_issue_date;
        $personalInformation->primary_mobile        =   $request->primary_mobile;
        $personalInformation->secondary_mobile      =   $request->secondary_mobile;
        $personalInformation->emergency_contact     =   $request->emergency_contact;
        $personalInformation->blood_group           =   $request->blood_group;
        $personalInformation->alternate_email       =   $request->alternate_email;
        $personalInformation->present_address       =   $request->present_address;
        $personalInformation->permanent_address     =   $request->permanent_address;
        $personalInformation->about_me              =   $request->about_me;
        $personalInformation->fb_link               =   $request->fb_link;
        $personalInformation->twitter_link          =   $request->twitter_link;
        $personalInformation->instagram_link        =   $request->instagram_link;
        $personalInformation->linked_link           =   $request->linked_link;
        $personalInformation->youtube_link          =   $request->youtube_link;
    }
    private function imageUpload($image, $directory){
//        $type = $image->getClientOriginalExtension();
        $imageName = Str::camel($image->getClientOriginalName());
        $image->move($directory, $imageName);
        return $directory.$imageName;
    }
    private function profileImageDirectory() {
        return 'assets/images/profile-image/';
    }

}
