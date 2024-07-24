<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Client;
use App\Models\InfoOrder;
use App\Models\Order;
use App\Models\DetailOrder;
use App\Models\Discount;
use App\Models\Money;
use Illuminate\Support\Facades\Mail;

use App\Rules\Captcha;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    //đăng nhập checkout
    public function client_login_checkout(Request $request){
        $url_canonical = $request->url();
        return view('client.checkout.client_login_checkout')->with('url_canonical',$url_canonical);
    }

    public function client_submit_login_checkout(Request $request){
        $client_email = $request->email_client;
        $client_password = md5($request->password_client);

        /* $result = Clients::where('client_email',$client_email)->where('client_password',$client_password)->first(); */ //so sánh (CDSL,biến trên)
        $result = Client::with('province')->with('district')->with('ward')
                        ->where('client_email', $client_email)->where('client_password', $client_password)->first();

        if(Session::get('fee_delivery')==false){
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
                return Redirect::to('/client_list_ajax_cart');
            }
            else{
                return Redirect::to('/client_login_checkout');
            }
        }else{
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
    }

    //thanh toán
    public function client_checkout(Request $request){
        $url_canonical = $request->url();
        return view('client.checkout.client_checkout')->with('url_canonical',$url_canonical);
    }
    //nhỏ hơn 300000
    public function client_submit_min_300000_checkout(Request $request){
        $data = $request->all();

        $info_order = new InfoOrder();
        $info_order->info_order_name = $data['info_order_name'];
        $info_order->info_order_email = $data['info_order_email'];
        $info_order->info_order_phone = $data['info_order_phone'];
        $info_order->province_id = Session::get('id_province');
        $info_order->district_id = Session::get('id_district');
        $info_order->ward_id = Session::get('id_ward');
        $info_order->info_order_address = $data['info_order_address'];
        $info_order->info_order_note = $data['info_order_note'];
        $info_order->save();
        $info_order_id = $info_order->info_order_id;

        $order = new Order();
        $order_code = substr(md5(microtime()),rand(0,26),12); //random chữ và sô lấy ra 12 chữ số bất kì
        $order->order_code = $order_code;
        $order->client_id = Session::get('client_id');
        $order->info_order_id = $info_order_id;
        Session::put('info_order_id',$order->info_order_id);
        $order->payment_id = 3;
        $order->discount_code = $data['discount_code'];

        $order->delivery_fee = $data['delivery_fee'];
        $order->status_id = 1;
        $order->status_shipper_id = 1;
        $order->order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->created_at = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order->save();

        if(Session::get('discount')!=NULL){
            $discount = Discount::where('discount_code',$data['discount_code'])->first();
            $discount->discount_amount = $discount->discount_amount - 1;
            $discount->discount_client = $discount->discount_client.','.Session::get('client_id');
            $discount_category = $discount->discount_category;
            $discount_be = $discount->discount_be;
            $discount_mail = $discount->discount_code;

            $discount->save();
        }else{
            $discount_be = '';
            $discount_category = '';
            $discount_mail = '';
        }

        if(Session::get('cart')==true){
            foreach (Session::get('cart') as $key => $cart){
                $detail_order = new DetailOrder();                         // bỏ ngoài foreach thì nó chỉ lưu cái cuối
                $detail_order->order_code = $order_code;
                Session::put('order_code',$detail_order->order_code);
                $detail_order->product_id = $cart['product_id'];        //cart controller
                $detail_order->product_name = $cart['product_name'];
                $detail_order->product_packing = $cart['product_packing'];
                $detail_order->product_price = $cart['product_price'];
                $detail_order->product_quantity = $cart['product_quantity'];

                $detail_order->save();
            }
        }

        $money = new Money();
        $money->order_code = $order_code;
        $money->money_product = 0;
        foreach (Session::get('cart') as $key => $cart){
            $money_product = $cart['product_price']*$cart['product_quantity'];
            $money->money_product += $money_product;
        }
        if (Session::get('discount')){
            foreach (Session::get('discount') as $key => $show_discount){
                if ($show_discount['discount_category'] == 1){
                    $money->money_discount = ($money->money_product*$show_discount['discount_be'])/100;
                }
                elseif($show_discount['discount_category'] == 2){
                    $money->money_discount = $show_discount['discount_be'];
                }
            }
        }else{
            $money->money_discount = 0;
        }
        $money->delivery_fee = $data['delivery_fee'];
        if (Session::get('discount') == true){
            $money->money_total = ($money->money_product - $money->money_discount) + $money->delivery_fee;
        }elseif(Session::get('discount') != true){
            $money->money_total = $money->money_product + $money->delivery_fee;
        }
        $money->save();

        /* gửi mail */
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');

        $title_mail = "Đơn hàng đã đặt thành công".' '.$today;
        $client = Client::find(Session::get('client_id'));
        $data['email'][] = $client->client_email;

        $province = Province::find(Session::get('id_province'));
        $province_name = $province->province_name;

        $district = District::find(Session::get('id_district'));
        $district_name = $district->district_name;

        $ward = Ward::find(Session::get('id_ward'));
        $ward_name = $ward->ward_name;

        $payment_method = 'Thanh toán khi nhận hàng';

        /* lấy giỏ hàng */
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart_mail){
                $cart_array[] = array(
                    'product_name' => $cart_mail['product_name'],
                    'product_packing' => $cart_mail['product_packing'],
                    'product_price' => $cart_mail['product_price'],
                    'product_quantity' => $cart_mail['product_quantity']
                );
            }
        }

        /* lấy thông tin người nhận hàng */
        $info_order_array = array(
            'info_order_name' => $data['info_order_name'],
            'info_order_email' => $data['info_order_email'],
            'info_order_phone' => $data['info_order_phone'],
            'province_name' => $province_name,
            'district_name' => $district_name,
            'ward_name' => $ward_name,
            'info_order_address' => $data['info_order_address'],
            'info_order_note' => $data['info_order_note']
        );

        if(Session::get('fee_delivery')==true){
            $fee = Session::get('fee_delivery');
        }else{
            $fee = 0;
        }

        /* lấy đơn hàng */
        $order_array = array(
            'created_at' => $today,
            'order_code' => $order_code,
            'client_name' => $client->client_name,
            'discount_category' => $discount_category,
            'discount_code' => $discount_mail,
            'discount_be' => $discount_be,
            'delivery_fee' => $fee,
            'payment_method' => $payment_method
        );

        Mail::send('admin.mail.admin_order_mail',[  'cart_array'=>$cart_array,
                                                    'info_order_array'=>$info_order_array,
                                                    'order_array'=>$order_array],
                                                    function($message) use ($data,$title_mail){
                                                        $message->to($data['email'])->subject($title_mail);
                                                        $message->from($data['email'],$title_mail);
                                                    });

        Session::forget('discount');
        Session::forget('fee_delivery');
        Session::forget('cart');
    }

    //lớn hơn 300000

    public function client_submit_max_300000_checkout(Request $request){
        $data = $request->all();

        $info_order = new InfoOrder();
        $info_order->info_order_name = $data['info_order_name'];
        $info_order->info_order_email = $data['info_order_email'];
        $info_order->info_order_phone = $data['info_order_phone'];
        if(Session::get('id_province')!=null){
            $info_order->province_id = Session::get('id_province');
            $info_order->district_id = Session::get('id_district');
            $info_order->ward_id = Session::get('id_ward');
        }else{
            $info_order->province_id = $data['province'];
            $info_order->district_id = $data['district'];
            $info_order->ward_id = $data['ward'];
        }

        $info_order->info_order_address = $data['info_order_address'];
        $info_order->info_order_note = $data['info_order_note'];
        $info_order->save();
        $info_order_id = $info_order->info_order_id;

        $order = new Order();
        $order_code = substr(md5(microtime()),rand(0,26),12); //random chữ và sô lấy ra 12 chữ số bất kì
        $order->order_code = $order_code;
        $order->client_id = Session::get('client_id');
        $order->info_order_id = $info_order_id;
        Session::put('info_order_id',$order->info_order_id);
        $order->payment_id = 3;
        $order->discount_code = $data['discount_code'];

        $order->delivery_fee = 0;
        $order->status_id = 1;
        $order->status_shipper_id = 1;
        $order->order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->created_at = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order->save();

        if(Session::get('discount')!=NULL){
            $discount = Discount::where('discount_code',$data['discount_code'])->first();
            $discount->discount_amount = $discount->discount_amount - 1;
            $discount->discount_client = $discount->discount_client.','.Session::get('client_id');
            $discount_category = $discount->discount_category;
            $discount_be = $discount->discount_be;
            $discount_mail = $discount->discount_code;

            $discount->save();
        }else{
            $discount_be = '';
            $discount_category = '';
            $discount_mail = '';
        }

        if(Session::get('cart')==true){
            foreach (Session::get('cart') as $key => $cart){
                $detail_order = new DetailOrder();                         // bỏ ngoài foreach thì nó chỉ lưu cái cuối
                $detail_order->order_code = $order_code;
                Session::put('order_code',$detail_order->order_code);
                $detail_order->product_id = $cart['product_id'];        //cart controller
                $detail_order->product_name = $cart['product_name'];
                $detail_order->product_packing = $cart['product_packing'];
                $detail_order->product_price = $cart['product_price'];
                $detail_order->product_quantity = $cart['product_quantity'];

                $detail_order->save();
            }
        }

        $money = new Money();
        $money->order_code = $order_code;
        $money->money_product = 0;
        foreach (Session::get('cart') as $key => $cart){
            $money_product = $cart['product_price']*$cart['product_quantity'];
            $money->money_product += $money_product;
        }
        if (Session::get('discount')){
            foreach (Session::get('discount') as $key => $show_discount){
                if ($show_discount['discount_category'] == 1){
                    $money->money_discount = ($money->money_product*$show_discount['discount_be'])/100;
                }
                elseif($show_discount['discount_category'] == 2){
                    $money->money_discount = $show_discount['discount_be'];
                }
            }
        }else{
            $money->money_discount = 0;
        }
        $money->delivery_fee = $data['delivery_fee'];
        if (Session::get('discount') == true){
            $money->money_total = ($money->money_product - $money->money_discount) + $money->delivery_fee;
        }elseif(Session::get('discount') != true){
            $money->money_total = $money->money_product + $money->delivery_fee;
        }
        $money->save();

        /* gửi mail */
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');

        $title_mail = "Đơn hàng đã đặt thành công".' '.$today;
        $client = Client::find(Session::get('client_id'));
        $data['email'][] = $client->client_email;

        $province_name = $info_order->province->province_name;
        $district_name = $info_order->district->district_name;
        $ward_name = $info_order->ward->ward_name;

        $payment_method = 'Thanh toán khi nhận hàng';

        /* lấy giỏ hàng */
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart_mail){
                $cart_array[] = array(
                    'product_name' => $cart_mail['product_name'],
                    'product_packing' => $cart_mail['product_packing'],
                    'product_price' => $cart_mail['product_price'],
                    'product_quantity' => $cart_mail['product_quantity']
                );
            }
        }

        /* lấy thông tin người nhận hàng */
        $info_order_array = array(
            'info_order_name' => $data['info_order_name'],
            'info_order_email' => $data['info_order_email'],
            'info_order_phone' => $data['info_order_phone'],
            'province_name' => $province_name,
            'district_name' => $district_name,
            'ward_name' => $ward_name,
            'info_order_address' => $data['info_order_address'],
            'info_order_note' => $data['info_order_note']
        );

        if(Session::get('fee_delivery')==true){
            $fee = Session::get('fee_delivery');
        }else{
            $fee = 0;
        }

        /* lấy đơn hàng */
        $order_array = array(
            'created_at' => $today,
            'order_code' => $order_code,
            'client_name' => $client->client_name,
            'discount_category' => $discount_category,
            'discount_code' => $discount_mail,
            'discount_be' => $discount_be,
            'delivery_fee' => $fee,
            'payment_method' => $payment_method
        );

        Mail::send('admin.mail.admin_order_mail',[  'cart_array'=>$cart_array,
                                                    'info_order_array'=>$info_order_array,
                                                    'order_array'=>$order_array],
                                                    function($message) use ($data,$title_mail){
                                                        $message->to($data['email'])->subject($title_mail);
                                                        $message->from($data['email'],$title_mail);
                                                    });

        Session::forget('discount');
        Session::forget('fee_delivery');
        Session::forget('cart');
    }


    //thanh toán vnpay
    public function client_vnpay_checkout(Request $request){

        $order_code_vnpay = substr(md5(microtime()),rand(0,26),12);

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/imported_fruit/client_submit_vnpay_checkout"; //thành công thì về đây
        $vnp_TmnCode = "JC57UY3N";//Mã website tại VNPAY
        $vnp_HashSecret = "NBZMCNOZLBTTYIMCXQELJBFGCNSEGFHG"; //Chuỗi bí mật

        $vnp_TxnRef = $order_code_vnpay; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán';
        $vnp_OrderType = 'VNPay';
        $vnp_Amount = $request->input('money_total') * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        $data = $request->all();

        $info_order = new InfoOrder();
        $info_order->info_order_name = $data['info_order_name'];
        $info_order->info_order_email = $data['info_order_email'];
        $info_order->info_order_phone = $data['info_order_phone'];

        if(Session::get('id_province')!=null){
            $info_order->province_id = Session::get('id_province');
            $info_order->district_id = Session::get('id_district');
            $info_order->ward_id = Session::get('id_ward');
        }else{
            $info_order->province_id = $data['province'];
            $info_order->district_id = $data['district'];
            $info_order->ward_id = $data['ward'];
        }

        $info_order->info_order_address = $data['info_order_address'];
        $info_order->info_order_note = $data['info_order_note'];
        $info_order->save();
        $info_order_id = $info_order->info_order_id;

        $order = new Order();
        $order_code = $order_code_vnpay; //random chữ và sô lấy ra 12 chữ số bất kì
        $order->order_code = $order_code;

        $order->client_id = Session::get('client_id');
        $order->info_order_id = $info_order_id;
        Session::put('info_order_id',$order->info_order_id);
        $order->payment_id = 2;
        $order->discount_code = $data['discount_code'];
        $order->delivery_fee = $data['delivery_fee'];
        $order->status_id = 1;
        $order->status_shipper_id = 1;
        $order->order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->created_at = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order->save();



        if(Session::get('cart')==true){
            foreach (Session::get('cart') as $key => $cart){
                $detail_order = new DetailOrder();                         // bỏ ngoài foreach thì nó chỉ lưu cái cuối
                $detail_order->order_code = $order_code;
                Session::put('order_code',$detail_order->order_code);
                $detail_order->product_id = $cart['product_id'];        //cart controller
                $detail_order->product_name = $cart['product_name'];
                $detail_order->product_packing = $cart['product_packing'];
                $detail_order->product_price = $cart['product_price'];
                $detail_order->product_quantity = $cart['product_quantity'];

                $detail_order->save();
            }
        }

        $money = new Money();
        $money->order_code = $order_code;
        $money->money_product = 0;
        foreach (Session::get('cart') as $key => $cart){
            $money_product = $cart['product_price']*$cart['product_quantity'];
            $money->money_product += $money_product;
        }
        if (Session::get('discount')){
            foreach (Session::get('discount') as $key => $show_discount){
                if ($show_discount['discount_category'] == 1){
                    $money->money_discount = ($money->money_product*$show_discount['discount_be'])/100;
                }
                elseif($show_discount['discount_category'] == 2){
                    $money->money_discount = $show_discount['discount_be'];
                }
            }
        }else{
            $money->money_discount = 0;
        }
        $money->delivery_fee = $data['delivery_fee'];
        if (Session::get('discount') == true){
            $money->money_total = ($money->money_product - $money->money_discount) + $money->delivery_fee;
        }elseif(Session::get('discount') != true){
            $money->money_total = $money->money_product + $money->delivery_fee;
        }
        $money->save();


        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00' , 'message' => 'success' , 'data' => $vnp_Url);

        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);



            die();
        } else {
            echo json_encode($returnData);
        }
    }

    //sau khi nhập otp
    public function client_submit_vnpay_checkout(){

        $order = Order::get();
        $order_code = $order->last()->order_code;
        $order_update = Order::where('order_code',$order_code)->first();
        $order_update->payment_id = 4;
        $order_update->save();


        if(Session::get('discount')!=NULL){
            $discount = Discount::where('discount_code',$order_update->discount_code)->first();
            $discount->discount_amount = $discount->discount_amount - 1;
            $discount->discount_client = $discount->discount_client.','.Session::get('client_id');
            $discount_category = $discount->discount_category;
            $discount_be = $discount->discount_be;
            $discount_mail = $discount->discount_code;

            $discount->save();
        }else{
            $discount_be = '';
            $discount_category = '';
            $discount_mail = '';
        }
        /* gửi mail */
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');

        $title_mail = "Đơn hàng đã đặt thành công".' '.$today;
        $client = Client::find(Session::get('client_id'));
        $data['email'][] = $client->client_email;

        $province = Province::find(Session::get('province_id'));
        $province_name = $province->province_name;

        $district = District::find(Session::get('district_id'));
        $district_name = $district->district_name;

        $ward = Ward::find(Session::get('ward_id'));
        $ward_name = $ward->ward_name;

        $payment_method = 'đã thanh toán VNPay';

        /* lấy giỏ hàng */
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart_mail){
                $cart_array[] = array(
                    'product_name' => $cart_mail['product_name'],
                    'product_packing' => $cart_mail['product_packing'],
                    'product_price' => $cart_mail['product_price'],
                    'product_quantity' => $cart_mail['product_quantity']
                );
            }
        }

        /* lấy thông tin người nhận hàng */
        $info_order_array = array(
            'info_order_name' => $order_update->info_order->info_order_name,
            'info_order_email' => $order_update->info_order->info_order_email,
            'info_order_phone' => $order_update->info_order->info_order_phone,
            'province_name' => $province_name,
            'district_name' => $district_name,
            'ward_name' => $ward_name,
            'info_order_address' => $order_update->info_order->info_order_address,
            'info_order_note' => $order_update->info_order->info_order_note
        );

        if(Session::get('fee_delivery')==true){
            $fee = Session::get('fee_delivery');
        }else{
            $fee = 0;
        }

        /* lấy đơn hàng */
        $order_array = array(
            'created_at' => $today,
            'order_code' => $order_code,
            'client_name' => $client->client_name,
            'discount_category' => $discount_category,
            'discount_code' => $discount_mail,
            'discount_be' => $discount_be,
            'delivery_fee' => $fee,
            'payment_method' => $payment_method
        );
        Session::put('order_code_detail',$order_code);

        Mail::send('admin.mail.admin_order_mail',[  'cart_array'=>$cart_array,
                                                    'info_order_array'=>$info_order_array,
                                                    'order_array'=>$order_array],
                                                    function($message) use ($data,$title_mail){
                                                        $message->to($data['email'])->subject($title_mail);
                                                        $message->from($data['email'],$title_mail);
                                                    });


        return Redirect('/client_thank_vnpay_checkout');

    }

    //cảm ơn vnpay
    public function client_thank_vnpay_checkout(Request $request){
        $url_canonical = $request->url();
        return view('client.checkout.client_thank_vnpay_checkout')->with('url_canonical',$url_canonical);
    }

    //Đăng ký
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



//}
}
