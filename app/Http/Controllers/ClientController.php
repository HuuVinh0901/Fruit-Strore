<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Order;
use App\Rules\Captcha;
use App\Models\Province;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class ClientController extends Controller
{
    //CLIENT{
    //Đăng ký
    public function client_register_client(Request $request){
        $url_canonical = $request->url();
        $province = Province::orderBy('province_id','ASC')->get();
        return view('client.client.client_register_client')
                    ->with('province',$province)
                    ->with('url_canonical',$url_canonical);
    }

    public function client_submit_register_client(Request $request){
        $database = $request->validate([
            'name_client' => 'required|min:3|max:30',
            'email_client' => 'required|email|unique:client,client_email',
            'password_client' => 'required|min:8',
            'phone_client' => 'required|digits:10,11|starts_with:0',
            'g-recaptcha' =>  new Captcha(), 		//dòng kiểm tra Captcha
        ]);
        $database = $request->all();
        $client = new Client();
        $client->client_name = $database['name_client'];            //CSDL = name
        $client->client_email = $database['email_client'];
        $client->client_password = md5($database['password_client']);
        $client->client_phone = $database['phone_client'];
        $client->province_id = $database['id_province'];
        $client->district_id = $database['id_district'];
        $client->ward_id = $database['id_ward'];
        $client->client_address = $database['address_client'];
        $client->client_vip = 0;
        $client->save();
        return Redirect('/client_login_client')->with('message','Đăng ký thành công vui lòng đăng nhập');
    }

    //đăng nhập
    public function client_login_client(Request $request){
        $url_canonical = $request->url();
        return view('client.client.client_login_client')->with('url_canonical',$url_canonical);
    }
    public function client_submit_login_client(Request $request){
        $client_email = $request->email_client;
        $client_password = md5($request->password_client);

        /* $result = Client::where('client_email',$client_email)->where('client_password',$client_password)->first(); */ //so sánh (CDSL,biến trên)
        $result = Client::with('province')->with('district')->with('ward')
                        ->where('client_email', $client_email)->where('client_password', $client_password)->first();

        if(Session::get('discount')==true){
            Session::forget('discount');
        }

        if(Session::get('fee_delivery')==true){
            Session::forget('fee_delivery');
        }

        if($result){
            session::put('client_id', $result->client_id);
            session::put('client_name', $result->client_name);
            session::put('client_email', $result->client_email);
            session::put('client_phone', $result->client_phone);

            session::put('province_id', $result->province_id);
            session::put('province_name', $result->province->province_name);

            session::put('district_id', $result->district_id);
            session::put('district_name', $result->district->district_name);

            session::put('ward_id', $result->ward_id);
            session::put('ward_name', $result->ward->ward_name);

            session::put('client_address', $result->client_address);

            return Redirect::to('/client_home_page');
        }
        else{
            return Redirect::to('/client_login_client')->with('message','Bạn nhập sai email hoặc mật khẩu');
        }
    }

    //đăng xuất
    public function client_logout_client(Request $request){
        $url_canonical = $request->url();
        session::flush();
        return redirect()->back()->with('url_canonical',$url_canonical);
    }

    //quên mật khẩu
    public function client_forget_client(Request $request){
        $url_canonical = $request->url();
        return view ('client.client.client_forget_client')->with('url_canonical',$url_canonical);
    }

    public function client_submit_forget_client(Request $request){
        $email_client = $request->email_client;

        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Lấy lại mật khẩu từ trái cây nhập khẩu ImportedFruit".' '.$today;
        $client_email = Client::where('client_email','=',$email_client)->get();

        foreach($client_email as $key => $show_client){
            $client_id = $show_client->client_id;
        }

        if($client_email){
            $count_client = $client_email->count();
            if($count_client==0){
                return Redirect::to('client_forget_client')->with('message','Email này chưa được đăng ký');
            }else{
                $token_random = Str::random();
                $client = Client::find($client_id);
                $client->client_token = $token_random;
                $client->save();

                $to_email = $email_client;
                $link_reset_password = url('client_new_password_client?email='.$to_email.'&token='.$token_random);

                $data = array(
                            "title"=>$title_mail,
                            "body"=>$link_reset_password,
                            "email"=>$email_client);

                Mail::send('client.mail.client_forget_password_mail',['data'=>$data], function ($message) use ($data,$title_mail){
                    $message->from($data['email'],$title_mail);
                    $message->to($data['email'])->subject($title_mail);
                });
                return Redirect::to('client_forget_client')->with('message','Gửi email thành công, vui lòng check mail để lấy lại mật khẩu');
            }
        }
    }

    //mật khẩu mới
    public function client_new_password_client(Request $request){
        $url_canonical = $request->url();
        return view ('client.client.client_new_password_client')->with('url_canonical',$url_canonical);
    }

    public function client_submit_new_password_client(Request $request){
        $data = $request->all();
        $token_random = Str::random();
        $client = Client::where('client_email','=',$data['email_client'])->where('client_token','=',$data['token_client'])->get();
        $count_client = $client->count();
        if($count_client>0){
            foreach($client as $key => $show_client){
                $client_id = $show_client->client_id;
            }
            $new_pasword = Client::find($client_id);
            $new_pasword->client_password = md5($data['new_password_client']);
            $new_pasword->client_token = $token_random;
            $new_pasword->save();
            return Redirect::to('client_login_client')->with('message','Cập nhật mật khẩu thành công. Vui lòng đăng nhập lại');
        }else{
            return Redirect::to('client_forget_client')->with('message',' Vui lòng nhập lại email, vì link đã quá hạn');
        }
    }


    //thông tin
    public function client_info_client($client_id, Request $request){
        $url_canonical = $request->url();
        $client_id = Session::get('client_id');
        $info_client = Client::with('province')->with('district')->with('ward')->where('client_id',$client_id)->get();
        return view('client.client.client_info_client')->with('info_client',$info_client)->with('url_canonical',$url_canonical);
    }

    /* chỉnh sửa thông tin */
    public function client_edit_client($client_id, Request $request){
        $url_canonical = $request->url();
        $client_id = Session::get('client_id');
        $info_client = Client::with('province')->with('district')->with('ward')->where('client_id',$client_id)->get();
        $province = Province::orderBy('province_id','ASC')->get();
        return view('client.client.client_edit_client',compact('info_client','province','url_canonical'));

    }
    public function client_submit_edit_client($client_id, Request $request){
        $data = $request->all();
        $client = Client::find($client_id);
        $client->client_name = $data['name_client'];
        $client->client_email = $data['email_client'];
        $client->client_phone = $data['phone_client'];
        $client->province_id = $data['province'];
        $client->district_id = $data['district'];
        $client->ward_id = $data['ward'];
        $client->client_address = $data['address_client'];
        $client->save();
        return Redirect::to('client_info_client/'.$client_id)->with('message','Bạn đã cập nhật thành công thông tin cá nhân');

    }



    /* đăng nhập google */
    /* public function client_login_google_client(){
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
        return Socialite::driver('google')->redirect();
    } */

//}


//ADMIN{
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

    //Danh sách
    public function admin_list_client(){
        $this->admin_test_login_admin();
        $client = Client::with('province')->with('district')->with('ward')
                            ->orderBy('client_id','DESC')->get();
        return view('admin.client.admin_list_client')->with('client',$client);
    }



    //Xóa
    public function admin_delete_client($client_id){
        $this->admin_test_login_admin();
        $client = Client::where('client_id',$client_id)->delete();
        return Redirect::to('/admin_list_client');
    }

    //đơn hàng theo client
    public function admin_list_order_client($client_id){
        $this->admin_test_login_admin();
        $order = Order::with('client')->with('info_order')->with('payment')->with('status')
                    ->where('client_id',$client_id)
                    ->orderBy('created_at','DESC')
                    ->get();
        $email_client = Order::with('client')
                            ->where('client_id',$client_id)
                            ->first();
        return view('admin.client.admin_list_order_client')->with('order',$order)->with('email_client',$email_client);
}

//}
}
