<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Socials;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{
    /* KIỂM TRA ĐƯỜNG DẪN */
    public function admin_test_login_admin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('admin_revenue_statistical');
        }
        else{
            return Redirect::to('/')->send();

        }
    }
    /* FACEBOOK */
    /* public function admin_login_facebook_admin(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(){
        $provider = Socialite::driver('facebook')->user(); //user là phương thức fb
        $account = Socials::where('social_provider_name','facebook')->where('social_provider_id',$provider->getId())->first(); // s_p_n(csdl)=fb(csdl)
        if($account){
            //login in vao trang quan tri
            $account_name = Admins::where('admin_id',$account->social)->first(); //social (socials) = admin_id (admins) trong csdl
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
        }else{

            $hieu = new Socials([
                'social_provider_id' => $provider->getId(),
                'social_provider_name' => 'facebook'
            ]);

            $orang = Admins::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Admins::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => ''

                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Admins::where('admin_id',$hieu->user)->first();

            Session::put('admin_login',$hieu->admin_name);
            Session::put('admin_id',$hieu->admin_id);

        }
        return redirect('/admin_home_dashboard')->with('message', 'Đăng nhập Admin thành công');
    } */

    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Socials::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri
            $account_name = Admin::where('admin_id',$account->user)->first();
            Session::put('admin_login',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/admin_revenue_statistical')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $hieu = new Socials([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Admin::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Admin::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_status' => 1

                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            Admin::where('admin_id',$hieu->user)->first();

            Session::put('admin_login',$hieu->admin_name);
            Session::put('admin_id',$hieu->admin_id);
            return redirect('/admin_revenue_statistical')->with('message', 'Đăng nhập Admin thành công');
        }
    }

    /* ĐĂNG NHẬP */
    public function admin_login_admin(){
        return view('admin.admin.admin_login_admin');
    }

    /* ĐĂNG XUẤT */
    public function admin_logout_admin(){
        $this->admin_test_login_admin();
        session::put('admin_name',null);
        session::put('admin_id',null);
        return Redirect::to('/admin_login_admin');
    }

}
