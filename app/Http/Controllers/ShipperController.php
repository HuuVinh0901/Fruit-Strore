<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\DetailOrder;
use App\Models\Money;
use App\Models\StatusShipper;
use App\Models\InfoOrder;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Discount;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

session_start();

class ShipperController extends Controller
{

    //đăng nhập
    public function admin_login_shipper(Request $request){
        return view('admin.shipper.admin_login_shipper');
    }
    public function admin_submit_login_shipper(Request $request){
        $admin_email = $request->email_admin;
        $admin_password = md5($request->password_admin);

        $result = Admin::where('admin_email', $admin_email)->where('admin_password', $admin_password)->get(); //nhập sai mật khẩu thì bị lỗi

        if($result){
            foreach($result as $key => $show_result){
                $shipper_id = $show_result->admin_id;
                $shipper_name = $show_result->admin_name;
            }//ra ngoài vì lấy 1 cái

            $shipper = AdminRole::with('admin')->where('admin_admin_id',$shipper_id)->where('role_role_id',4)->first();

            if($shipper){
                session::put('shipper_id',$shipper_id);
                session::put('shipper_name',$shipper_name);
                return Redirect::to('/admin_list_order_shipper');
            }
            else{
                return Redirect::to('/admin_login_shipper')->with('message','Bạn nhập sai mật khẩu hoặc email');
            }
        }
        else{
            return Redirect::to('/admin_login_shipper')->with('message','Bạn nhập sai mật khẩu hoặc email');
        }

    }


    //danh sách đơn hàng
    public function admin_list_order_shipper(){
        $shipper_id = session::get('shipper_id');
        if($shipper_id){
            $shipper_order = Order::with('status')
                                    ->orwhere('status_id',3)
                                    ->where('admin_id',$shipper_id)
                                    ->get();

            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $money_total = 0;
            $order = Order::where('payment_id',3)->where('status_shipper_id',2)->get();
            foreach($order as $key1 => $show){
                $order_code = $show->order_code;
                $money = Money::where('order_code',$order_code)->get();
                foreach($money as $key2 => $show_money){
                    $money_total += $show_money->money_total;
                }
            }

        }
        return view('admin.shipper.admin_list_order_shipper')
                ->with('shipper_order',$shipper_order)
                ->with('money_total',$money_total);
    }


    //chi tiết đơn hàng
    public function admin_detail_order_shipper($order_code){
        $detail_order = DetailOrder::where('order_code',$order_code)->get();
        Session::put('order_code',$order_code);
        $list_status_shipper = StatusShipper::orderBy('status_shipper_id','ASC')->get();
        $order = Order::with('admin')->where('order_code',$order_code)->get();
        foreach($order as $key => $show_order){
            $client_id = $show_order->client_id;
            $info_order_id = $show_order->info_order_id;
            $payment_id = $show_order->payment_id;
            $discount_order = $show_order->discount_code;
            $status_shipper_id = $show_order->status_shipper_id;
        }//ra ngoài vì lấy 1 cái
        $client = Client::where('client_id',$client_id)->first(); //lấy 1 khách hàng dựa trên 1 id

        $info_order = InfoOrder::with('province')->with('district')->with('ward')->where('info_order_id',$info_order_id)->first();

        $payment = Payment::where('payment_id',$payment_id)->first(); //lấy vận chuyển 1 nơi

        $discount = Discount::where('discount_code',$discount_order)->first();

        $status_shipper = StatusShipper::where('status_shipper_id',$status_shipper_id)->first(); //lấy vận chuyển 1 nơi


        return view('admin.shipper.admin_detail_order_shipper')
                ->with('detail_order',$detail_order)
                ->with('list_status_shipper',$list_status_shipper)
                ->with('client',$client)
                ->with('info_order',$info_order)
                ->with('order',$order)
                ->with('payment',$payment)
                ->with('discount',$discount)
                ->with('status_shipper',$status_shipper);
    }

    //cập nhật
    public function admin_update_status_order_shipper(Request $request){

        $data = $request->all();
        $order = Order::with('admin')->with('status_shipper')->find($data['order_id']);
        $order->status_shipper_id = $data['order_status_shipper'];
        $order->save();

        /* phần mail */
        $order_code = $order->order_code;

        $status_shipper_id = $order->status_shipper_id;

        $shipper = $order->admin->admin_name;

        /* gửi mail */
        $todayy = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');

        $title_mail = 'Trạng thái đơn hàng từ nhân viên giao hàng '.$shipper.' '.$todayy;
        $data['email'] = 'thub1910152@student.ctu.edu.vn';

        /* lấy đơn hàng */
        $order_array = array(
            'created_at' => $todayy,
            'order_code' => $order_code,
            'shipper' => $shipper,
            'status_shipper_id' => $status_shipper_id
        );

        Mail::send('admin.shipper.admin_mail_status_order_shipper',[ 'order_array'=>$order_array],
                                                    function($message) use ($data,$title_mail){
                                                        $message->to($data['email'])->subject($title_mail);
                                                        $message->from($data['email'],$title_mail);
                                                    });
    }


}
