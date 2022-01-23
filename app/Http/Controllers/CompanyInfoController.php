<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class CompanyInfoController extends Controller
{
    private $user ;
    private $userRoute ;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $this->user = $user;
            $userRoles = $user->roles;
            $userRoute = [];
            if($user->type == 1){
                foreach (Route::getRoutes()->getRoutes() as $key => $route){
                    array_push($userRoute, $route->getName());
                }
            } else{
                foreach ($user->roles as $role){
                    foreach ($role->roleRoutes as $routes){
                        array_push($userRoute, $routes->route_name);
                    }
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
        $userRoutes = $this->userRoute;
        $company = CompanyInfo::all();
        if ($company->count() > 0) {
            $company = CompanyInfo::first();
            return view('backend.company.edit-company', compact('company', 'userRoutes'));
        }
        return view('backend.company.add-company', compact('userRoutes'));
    }
    public function store(Request $request){
        //        return $request->all();
        $company = CompanyInfo::all();
        if ($company->count() > 0) {
            $company = CompanyInfo::first();
        } else {
            $company = new CompanyInfo();
        }

        $logoOne  = $request->file('logo_one');
        if ($logoOne) {
            if ($company->logo_one) {
                if (file_exists($company->logo_one)) {
                    unlink($company->logo_one);
                }
            }
            $company->logo_one = $this->imageUpload($logoOne, $this->companyLogoDirectory());
        }
        $logoTwo  = $request->file('logo_two');
        if ($logoTwo) {
            if ($company->logo_two) {
                if (file_exists($company->logo_two)) {
                    unlink($company->logo_two);
                }
            }
            $company->logo_two = $this->imageUpload($logoTwo, $this->companyLogoDirectory());
        }
        $company->name                      =       $request->name;
        $company->slogan                    =       $request->slogan;
        $company->about_blog                =       $request->about_blog;
        $company->mission                   =       $request->mission;
        $company->vision                    =       $request->vision;
        $company->email                     =       $request->email;
        $company->address                   =       $request->address;
        $company->phone_one                 =       $request->phone_one;
        $company->phone_two                 =       $request->phone_two;
        $company->company_color             =       $request->company_color;
        $company->fb_link                   =       $request->fb_link;
        $company->twitter_link              =       $request->twitter_link;
        $company->youtube_link              =       $request->youtube_link;
        $company->instagram_link            =       $request->instagram_link;
        $company->linked_link               =       $request->linked_link;
        $company->save();
        return redirect()->back()->with('message', 'CompanyInfo Updated successfully!');
    }
    private function imageUpload($image, $directory){
//        $type = $image->getClientOriginalExtension();
        $imageName = Str::camel($image->getClientOriginalName());
        $image->move($directory, $imageName);
        return $directory.$imageName;
    }

    private function companyLogoDirectory(){
        return 'assets/images/company-logo/';
    }
}
