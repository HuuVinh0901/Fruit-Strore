<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandController extends Controller
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
    public function admin_list_brand(){
        $this->admin_test_login_admin();
        $list_brand = Brand::all();  /* lấy tất cả dữ liệu bảng */
        $show_brand = view('admin.brand.admin_list_brand')->with('list_brand',$list_brand); /* with(đặt tên,biên ở trên) đặt tên hồi đem qua for || biến gán dữ liệu cho đặt tên*/
        return view('admin_layout')->with('admin.brand.admin_list_brand',$show_brand);
    }


    /* THÊM */
    public function admin_add_brand(){
        $this->admin_test_login_admin();
        return view('admin.brand.admin_add_brand');
    }
    public function admin_submit_add_brand(Request $request){ /* request lấy yêu cầu dữ liệu */
        $this->admin_test_login_admin();
        $database = $request->all();
        $brand = new Brand();
        $brand->brand_name = $database['name_brand'];                                              /* tự đặt biến */
        $brand->brand_address = $database['address_brand'];                                              /* tự đặt biến */
        $brand->brand_phone = $database['phone_brand'];                                              /* tự đặt biến */
        $brand->brand_status = $database['status_brand'];                                              /* tự đặt biến */
        $database['brand_name'] = $request -> name_brand;  /* tên CSDL = name */
        $brand->save();
        session::put('message',"Thêm thương hiệu sản phẩm thành công.");
        return Redirect::to('/admin_add_brand'); /* thêm xong trả về */
    }


    /* ẨN HIỆN */
    public function admin_display_brand($brand_id){
        $this->admin_test_login_admin();
        Brand::where('brand_id',$brand_id)->update(['brand_status'=>0]);
        session::put('message', "Ẩn thương hiệu thành công");
        return Redirect()->to('/admin_list_brand');
    }
    public function admin_undisplay_brand($brand_id){
        $this->admin_test_login_admin();
        Brand::where('brand_id',$brand_id)->update(['brand_status'=>1]);
        session::put('message', "Hiện thương hiệu thành công");
        return Redirect::to('/admin_list_brand');
    }


    /* SỬA */
    public function admin_edit_brand($brand_id){
        $this->admin_test_login_admin();
        $edit_brand = Brand::where('brand_id',$brand_id)->get(); /* first lấy 1 cái */
        $show_brand = view('admin.brand.admin_edit_brand')->with('edit_brand',$edit_brand); /* with(đặt tên,biên ở trên) đặt tên hồi đem qua for || biến gán dữ liệu cho đặt tên*/
        return view('admin_layout')->with('admin.brand.admin_edit_brand',$show_brand);
    }
    public function admin_update_edit_brand(Request $request, $brand_id){
        $this->admin_test_login_admin();
        $database = $request->all();
        $brand = Brand::find($brand_id);
        $brand->brand_name = $database['name_brand'];                                              /* tự đặt biến */
        $brand->brand_address = $database['address_brand'];                                              /* tự đặt biến */
        $brand->brand_phone = $database['phone_brand'];
        $brand->save();
        session::put('message',"Chỉnh sửa thương hiệu sản phẩm thành công.");
        return Redirect::to('/admin_list_brand');
    }


    /* XÓA */
    public function admin_delete_brand($brand_id){
        $this->admin_test_login_admin();
        Brand::where('brand_id',$brand_id)->delete(); /* first lấy 1 cái */
        session::put('message',"Xóa thương hiệu sản phẩm thành công.");
        return Redirect::to('/admin_list_brand');
    }
}
