<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cost;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
session_start();
class CostController extends Controller
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


    /* DANH SÁCH */
    public function admin_list_cost(){
        $this->admin_test_login_admin();
        $list_cost = Cost::with('product')->get();
        return view('admin.cost.admin_list_cost')->with('list_cost',$list_cost);
    }

    /* THÊM */
    public function admin_add_cost(){
        $this->admin_test_login_admin();
        $product = Product::whereNotIn('product_id', function ($query) {
                            $query->select('product_id')->from('cost');})->get();
        return view('admin.cost.admin_add_cost')->with('product',$product); //tên khai báo,biến ở trên
    }
    public function admin_submit_add_cost(Request $request){ /* request lấy yêu cầu dữ liệu */
        $this->admin_test_login_admin();
        $buy_cost = filter_var($request->buy_cost,FILTER_SANITIZE_NUMBER_INT);
        $cost = new Cost();
        $cost->product_id = $request->product;
        $cost->cost_buy = $buy_cost;
        $cost->save();
        session::put('message',"Thêm giá gốc cho sản phẩm thành công");
        return Redirect::to('/admin_add_cost');
        /* foreach($cost->product_id as $key => $find_product_id){
            if($cost->product_id != $find_product_id->product_id){
                session::put('message',"Thêm giá gốc cho sản phẩm thành công.");
                return Redirect::to('/admin_add_cost');
            }else{
                session::put('message',"Thêm giá gốc cho sản phẩm không thành công. Vì sản phẩm đã có giá gốc");
                return Redirect::to('/admin_add_cost');
            }
        } */
    }


    /* SỬA */
    public function admin_edit_cost($cost_id){
        $this->admin_test_login_admin();
        $edit_cost = Cost::with('product')->where('cost_id',$cost_id)->get(); /* first lấy 1 cái */
        return view('admin.cost.admin_edit_cost')->with('edit_cost',$edit_cost);
    }
    public function admin_update_edit_cost(Request $request, $cost_id){
        $this->admin_test_login_admin();
        $buy_cost = filter_var($request->buy_cost,FILTER_SANITIZE_NUMBER_INT);
        $cost = Cost::find($cost_id);
        $cost->cost_buy = $buy_cost;
        $cost->save();
        session::put('message',"Chỉnh sửa giá gốc cho sản phẩm thành công.");
        return Redirect::to('/admin_list_cost'); /* thêm xong trả về */
    }


    /* XÓA */
    public function admin_delete_cost($cost_id){
        $this->admin_test_login_admin();
        $cost = Cost::find($cost_id);
        $cost->delete();
        session::put('message',"Xóa giá gốc sản phẩm thành công.");
        return Redirect::to('/admin_list_cost');
    }
}
