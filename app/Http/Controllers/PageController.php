<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function admin_test_login_admin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('admin_revenue_statistical');
        }
        else{
            return Redirect::to('/')->send();

        }
    }

    public function send_email(){
        $to_name = "B1910152";
        $to_email = "lethu23102001@gmail.com";

        $data = array("name"=>"Mail từ tài khoản khách hàng","body"=>"Vấn đề hàng hóa");
        Mail::send('client.page.send_email', $data, function ($message) use ($to_name,$to_email) {
            $message->to($to_email)->subject('Test');
            $message->from($to_email,$to_name);
        });
    }




//CLIENT
    /* TRANG CHỦ */
    public function client_home_page(Request $request){
        $url_canonical = $request->url();

        $product_sale = Product::where('product_sale','<>',NULL)->where('product_status',1)->take(4)->get();

        $product_new = Product::where('product_sale',NULL)->where('product_status','1')->orderBy('product_id','desc')->limit(8)->get();

        $product_max = $product_max=Product::orderBy('product_sold', 'desc')->take(2)->get();

        $advertise = Advertise::where('advertise_status','1')->orderBy('advertise_id','ASC')->take(3)->get();

        return view('client.page.client_home_page',compact('product_new','advertise','url_canonical','product_sale','product_max'));
    }

}
