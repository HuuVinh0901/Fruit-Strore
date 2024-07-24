<?php

namespace App\Http\Controllers;

use App\Models\Discount;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
class DiscountController extends Controller
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
    public function admin_add_discount(){
        $this->admin_test_login_admin();
        return view('admin.discount.admin_add_discount');
    }
    public function admin_submit_add_discount(Request $request){
        $this->admin_test_login_admin();
        $database = $request->all();
        $discount = new Discount();
        $discount->discount_code = $database['code_discount'];  //CSDL = name
        $discount->discount_name = $database['name_discount'];
        $discount->discount_amount = $database['amount_discount'];
        $discount->discount_category = $database['category_discount'];
        $discount->discount_be = $database['be_discount'];
        $discount->discount_start = $database['start_discount'];
        $discount->discount_end = $database['end_discount'];
        $discount->save();
        session::put('message', 'Thêm mã giảm giá thành công');
        return Redirect::to('admin_add_discount');
    }

    public function admin_list_discount(){
        $this->admin_test_login_admin();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $discount = Discount::orderBy('discount_id','desc')->get();
        return view('admin.discount.admin_list_discount')
                    ->with('today',$today)
                    ->with('discount',$discount);
    }

    public function admin_delete_discount($discount_id){
        $this->admin_test_login_admin();
        $discount = Discount::find($discount_id);
        $discount->delete();
        session::put('message', 'Xóa mã giảm giá thành công');
        return Redirect::to('admin_list_discount');
    }


//CLIENT
    /* kiểm tra giảm giá */
    public function client_check_discount(Request $request){
        $database = $request->all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        /* nếu có đăng nhập */
        if(Session::get('client_id')){
            $data_discount = Discount::where('discount_code',$database['discount'])//where CSDL = name input
                                        ->where('discount_end','>=',$today)
                                        ->where('discount_client','LIKE','%'.Session::get('client_id').'%')
                                        ->first();

            /* nếu đã đã sử dụng mã đó */
            if($data_discount){
                return Redirect()->back()->with('message','Bạn đã sử dụng mã giảm giá này. Vui lòng nhập mã giảm giá khác');

            /* nếu chưa sử dụng mã đó */
            }else{
                $data_discount = Discount::where('discount_code',$database['discount'])//where CSDL = name input
                                            ->where('discount_end','>=',$today)
                                            ->first();

                /* nếu nhập đúng mã */
                if($data_discount == true){
                    $count_discount = $data_discount->count();
                    if($count_discount > 0){
                        $session_discount = Session::get('discount');                   //tạo session lưu mã giảm giá
                        if($session_discount == true){
                            $is_avaliable = 0;                                          // có tồn tại không
                            if($is_avaliable == 0){                                     // session tồn tại
                                $discount[] = array(
                                    'discount_code' => $data_discount['discount_code'],   // tên đặt => CSDL
                                    'discount_category' => $data_discount['discount_category'],
                                    'discount_be' => $data_discount['discount_be'],
                                );
                                Session::put('discount',$discount);
                            }
                        }
                        else{
                            $discount[] = array(
                                'discount_code' => $data_discount['discount_code'],   // tên đặt => CSDL
                                'discount_category' => $data_discount['discount_category'],
                                'discount_be' => $data_discount['discount_be'],
                            );
                            Session::put('discount',$discount);
                        }
                        Session::save();
                        return Redirect::to('client_list_ajax_cart')->with('messages','Thêm mã giảm giá thành công');
                    }
                }else{
                    return redirect()->back()->with('messages','Mã giảm giá không tồn tại hoặc đã hết hạn');
                }
            }
        }

        /* không đăng nhập */
        else{
            $data_discount = Discount::where('discount_code',$database['discount'])//where CSDL = name input
                                        ->where('discount_end','>=',$today)
                                        ->first();
            if($data_discount == true){
                $count_discount = $data_discount->count();
                if($count_discount > 0){
                    $session_discount = Session::get('discount');                   //tạo session lưu mã giảm giá
                    if($session_discount == true){
                        $is_avaliable = 0;                                          // có tồn tại không
                        if($is_avaliable == 0){                                     // session tồn tại
                            $discount[] = array(
                                'discount_code' => $data_discount['discount_code'],   // tên đặt => CSDL
                                'discount_category' => $data_discount['discount_category'],
                                'discount_be' => $data_discount['discount_be'],
                            );
                            Session::put('discount',$discount);
                        }
                    }
                    else{
                        $discount[] = array(
                            'discount_code' => $data_discount['discount_code'],   // tên đặt => CSDL
                            'discount_category' => $data_discount['discount_category'],
                            'discount_be' => $data_discount['discount_be'],
                        );
                        Session::put('discount',$discount);
                    }
                    Session::save();
                    return Redirect::to('client_list_ajax_cart')->with('messages','Thêm mã giảm giá thành công');
                }
            }else{
                return redirect()->back()->with('messages','Mã giảm giá không tồn tại hoặc đã hết hạn');
            }
        }
    }

    public function client_delete_discount(){
        $discount = session::get('discount');
        if($discount == true){
            session::forget('discount');
            return redirect()->back()->with('messages','Xóa mã giảm giá thành công!');
        }
    }

}
