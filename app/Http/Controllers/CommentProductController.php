<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Province;
use App\Models\Client;
use App\Rules\Captcha;
use Illuminate\Support\Facades\DB;
session_start();

class CommentProductController extends Controller
{
//CLIENT{
    public function client_submit_comment_product(Request $request){
        $data = $request->all();
        $comment_product = new CommentProduct();
        $comment_product->product_id = $data['product_id'];
        $comment_product->comment_product_detail = $data['comment_product_detail'];
        $comment_product->client_id = Session::get('client_id');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $comment_product->created_at = now();
        $comment_product->save();
    }
    public function client_comment_product(Request $request){
        $product_id = $request->product_id;
        $show='';
        $comment_product = CommentProduct::with('client')->where('client_id','!=',NULL)->where('product_id',$product_id)->get(); //where(csdl,biến ở trên) //lấy ra những cmt dựa vào product id trong csdl
        $reply_comment_product = CommentProduct::get();
        foreach($comment_product as $key => $cmt){
            $show.='
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-start">
                        <img class="rounded-circle shadow-1-strong mr-3" src="'.URL('public/frontend/images/avatar.png').'" alt="avatar" width="50" height="50" />
                        <div class="flex-grow-1 flex-shrink-1">
                            <div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-1">
                                        <b>'.$cmt->client->client_name.'</b> <span class="small"> - '.date_format($cmt->created_at,'H:i:s d/m/Y').'</span>
                                    </p>

                                </div>
                                <p class="small mb-0">
                                    '.$cmt->comment_product_detail.'
                                </p>
                            </div>';
                            foreach($reply_comment_product as $key => $rep){
                                if($rep->comment_product_reply == $cmt->comment_product_id){
                                    $show.=
                                    '<div class="d-flex flex-start mt-4">
                                        <a class="mr-3" href="#">
                                            <img class="rounded-circle shadow-1-strong" src="'.URL('public/frontend/images/avatar.png').'" alt="avatar" width="50" height="50" />
                                        </a>
                                        <div class="flex-grow-1 flex-shrink-1">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="mb-1"><b>ImportedFruit</b> <span class="small"> '.date_format($rep->created_at,'H:i:s d/m/Y').'</span> </p>
                                                </div>
                                                <p class="small mb-0">'.$rep->comment_product_detail.'</p>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                            $show.='
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-5"><hr></div>';
        };
        echo $show;
    }
/* đang không dùng ----------------------------------------------*/
    /* ĐĂNG NHẬP*/
    public function client_login_comment_product(Request $request){
        $url_canonical = $request->url();
        return view('client.comment_product.client_login_comment_product')->with('url_canonical',$url_canonical);
    }

    public function client_submit_login_comment_product(Request $request){
        $client_email = $request->email_client;
        $client_password = md5($request->password_client);

        /* $result = Clients::where('client_email',$client_email)->where('client_password',$client_password)->first(); */ //so sánh (CDSL,biến trên)
        $result = Client::with('province')->with('district')->with('ward')
                        ->where('client_email', $client_email)->where('client_password', $client_password)->first();

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
            return Redirect::to('/client_checkout');
        }
        else{
            return Redirect::to('/client_login_checkout');
        }
    }
    /* ĐĂNG Ký */
    public function client_register_checkout(Request $request){
        $url_canonical = $request->url();
        $province = Province::orderBy('province_id','ASC')->get();
        return view('client.client.client_register_checkout')
                    ->with('province',$province)
                    ->with('url_canonical',$url_canonical);
    }

    public function client_submit_register_checkout(Request $request){
        $database = $request->validate([
            'name_client' => 'required|min:3|max:30',
            'email_client' => 'required|email|unique:clients,client_email',
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
        $client->save();
        return Redirect('/client_login_checkout')->with('message','Đăng ký thành công vui lòng đăng nhập');
    }
/* đang không dùng ----------------------------------------------*/

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

    /* DANH SÁCH */
    public function admin_list_comment_product(){
        $this->admin_test_login_admin();
        $reply_comment_product = CommentProduct::get();
        $comment_product = CommentProduct::with('client')->with('product')->where('client_id','!=',NULL)
                                            ->orderBy('comment_product_id','DESC')->get();
        return view('admin.comment_product.admin_list_comment_product')
                ->with('comment_product',$comment_product)
                ->with('reply_comment_product',$reply_comment_product);
    }

    /* TRẢ LỜI */
    public function admin_reply_comment_product(Request $request){
        $data = $request->all();
        $comment_product = new CommentProduct();
        $comment_product->comment_product_detail = $data['comment_product_detail'];
        $comment_product->product_id = $data['product_id'];
        $comment_product->comment_product_reply = $data['comment_product_id'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $comment_product->created_at = now();
        $comment_product->save();
    }

    /* XÓA */
    public function admin_delete_comment_product($comment_product_id){
        $this->admin_test_login_admin();
        $comment_product = CommentProduct::find($comment_product_id);
        $comment_product->delete();
        session::put('message',"Xóa bình luận thành công.");
        return Redirect::to('/admin_list_comment_product');
    }
//}
}
