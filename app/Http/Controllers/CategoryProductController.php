<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CategoryProduct;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryProductController extends Controller
{
//START_ADMIN{
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
    public function admin_list_category_product(){
        $this->admin_test_login_admin();
        $list_category_product = CategoryProduct::all();
        return view('admin.category_product.admin_list_category_product')->with('list_category_product',$list_category_product);
    }


    /* THÊM */
    public function admin_add_category_product(){
        $this->admin_test_login_admin();
        return view('admin.category_product.admin_add_category_product');
    }
    public function admin_submit_add_category_product(Request $request){ /* request lấy yêu cầu dữ liệu */
        $this->admin_test_login_admin();
        $database = $request->all();
        $category_product = new CategoryProduct(); // new class bên model thêm mới
        $category_product->category_product_name = $database['name_category_product'];
        $category_product->category_product_status = $database['status_category_product'];
        $category_product->save();
        session::put('message',"Thêm danh mục sản phẩm thành công.");
        return Redirect::to('/admin_add_category_product'); /* thêm xong trả về */
    }


    /* ẨN HIỆN */
    public function admin_display_category_product($category_product_id){
        $this->admin_test_login_admin();
        CategoryProduct::where('category_product_id',$category_product_id)->update(['category_product_status'=>0]);
        session::put('message', "Ẩn danh mục thành công");
        return Redirect::to('/admin_list_category_product');
    }
    public function admin_undisplay_category_product($category_product_id){
        $this->admin_test_login_admin();
        CategoryProduct::where('category_product_id',$category_product_id)->update(['category_product_status'=>1]);
        session::put('message', "Hiện danh mục thành công");
        return Redirect::to('/admin_list_category_product');
    }


    /* SỬA */
    public function admin_edit_category_product($category_product_id){
        $this->admin_test_login_admin();
        // $edit_category_product = CategoryProduct::find($category_product_id); //id truyền ở hàm. Dùng find bên kia không cần dùng foreach
        $edit_category_product = CategoryProduct::where('category_product_id',$category_product_id)->get();
        $show_category_product = view('admin.category_product.admin_edit_category_product')->with('edit_category_product',$edit_category_product); /* with(đặt tên,biên ở trên) đặt tên hồi đem qua for || biến gán dữ liệu cho đặt tên*/
        return view('admin_layout')->with('admin.category_product.admin_edit_category_product',$show_category_product);
    }
    public function admin_update_edit_category_product(Request $request, $category_product_id){
        $this->admin_test_login_admin();
        $database = $request->all();
        $category_product = CategoryProduct::find($category_product_id); // tìm sản phẩm dựa trên id
        $category_product->category_product_name = $database['name_category_product'];
        $category_product->save();
        session::put('message',"Chỉnh sửa danh mục sản phẩm thành công.");
        return Redirect::to('/admin_list_category_product');
    }


    /* XÓA */
    public function admin_delete_category_product($category_product_id){
        $this->admin_test_login_admin();
        CategoryProduct::find($category_product_id)->delete();
        session::put('message',"Xóa danh mục sản phẩm thành công.");
        return Redirect::to('/admin_list_category_product');
    }
//}END_ADMIN
}
