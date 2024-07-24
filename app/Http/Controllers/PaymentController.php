<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Order;
use App\Models\Money;
use Illuminate\Support\Carbon;
use App\Models\Discount;
use App\Models\Ward;
use App\Models\District;
use App\Models\DetailOrder;
use App\Models\Client;
use App\Models\InfoOrder;
use Illuminate\Support\Facades\Mail;
session_start();
class PaymentController extends Controller
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
    //DANH SÁCH

    public function admin_list_payment(){
        $this->admin_test_login_admin();
        $list_payment = Payment::all();  /* lấy tất cả dữ liệu bảng */
        $show_payment = view('admin.payment.admin_list_payment')->with('list_payment',$list_payment); /* with(đặt tên,biên ở trên) đặt tên hồi đem qua for || biến gán dữ liệu cho đặt tên*/
        return view('admin_layout')->with('admin.payment.admin_list_payment',$show_payment);
    }


    /* THÊM */
    public function admin_add_payment(){
        $this->admin_test_login_admin();
        return view('admin.payment.admin_add_payment');
    }
    public function admin_submit_add_payment(Request $request){ /* request lấy yêu cầu dữ liệu */
        $database = $request->all();
        $payment = new Payment();
        $payment->payment_method = $database['method_payment'];
        $payment->payment_status = $database['status_payment'];        /* CSDL = name */
        $payment->save();
        session::put('message',"Thêm phương thức thanh toán thành công.");
        return Redirect::to('/admin_add_payment'); /* thêm xong trả về */
    }


    /* ẨN HIỆN */
    public function admin_display_payment($payment_id){
        $this->admin_test_login_admin();
        Payment::where('payment_id',$payment_id)->update(['payment_status'=>0]); /* vào table điều kiện là id trong bảng csdl = tham số hàm -> update mảng [0,1] trạng thái (chưa hiểu)*/
        session::put('message', "Ẩn thương hiệu thành công");
        return Redirect::to('/admin_list_payment');
    }
    public function admin_undisplay_payment($payment_id){
        $this->admin_test_login_admin();
        Payment::where('payment_id',$payment_id)->update(['payment_status'=>1]); /* vào table điều kiện là id trong bảng csdl = tham số hàm -> update mảng [0,1] trạng thái (chưa hiểu)*/
        session::put('message', "Hiện thương hiệu thành công");
        return Redirect::to('/admin_list_payment');
    }


    /* SỬA */
    public function admin_edit_payment($payment_id){
        $this->admin_test_login_admin();
        $edit_payment = Payment::where('payment_id',$payment_id)->get(); /* first lấy 1 cái */
        $show_payment = view('admin.payment.admin_edit_payment')->with('edit_payment',$edit_payment); /* with(đặt tên,biên ở trên) đặt tên hồi đem qua for || biến gán dữ liệu cho đặt tên*/
        return view('admin_layout')->with('admin.payment.admin_edit_payment',$show_payment);
    }
    public function admin_update_edit_payment(Request $request, $payment_id){
        $this->admin_test_login_admin();
        $database = $request->all();
        $payment = Payment::find($payment_id);
        $payment->payment_method = $database['method_payment'];
        $payment->save(); /* csdl = ts hàm */
        session::put('message',"Chỉnh sửa phương thức thành công.");
        return Redirect::to('/admin_list_payment');
    }


    /* XÓA */
    public function admin_delete_payment($payment_id){
        $this->admin_test_login_admin();
        Payment::where('payment_id',$payment_id)->delete(); /* first lấy 1 cái */
        session::put('message',"Xóa phương thức thành công.");
        return Redirect()->to('/admin_list_payment');
    }





//CLIENT{

    //phương thức thanh toán
    public function client_list_payment(Request $request){
        $url_canonical = $request->url();
        $province = Province::orderBy('province_id','ASC')->get();
        $payment = Payment::where('payment_status','1')->orderBy('payment_id','desc')->get();
        return view('client.checkout.client_checkout')->with('province',$province)->with('payment',$payment)->with('url_canonical',$url_canonical);
    }

//}
}
