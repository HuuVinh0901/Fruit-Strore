<?php

namespace App\Http\Controllers;

use App\Models\Origin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class OriginController extends Controller
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
    public function admin_list_origin(){
        $this->admin_test_login_admin();
        $list_origin = Origin::all();
        $show_origin = view('admin.origin.admin_list_origin')
                                    ->with('list_origin',$list_origin); /* with(đặt tên,biên ở trên) đặt tên hồi đem qua for || biến gán dữ liệu cho đặt tên*/
        return view('admin_layout')
                ->with('admin.origin.admin_list_origin',$show_origin);
    }


    /* THÊM */
    public function admin_add_origin(){
        $this->admin_test_login_admin();
        return view('admin.origin.admin_add_origin');
    }
    public function admin_submit_add_origin(Request $request){ /* request lấy yêu cầu dữ liệu */
        $this->admin_test_login_admin();
        $database = $request->all();
        $origin = new Origin(); // new class bên model thêm mới
        $origin->origin_name = $database['name_origin'];
        $origin->origin_status = $database['status_origin'];
        $origin->save();
        session::put('message',"Thêm xuất xứ thành công.");
        return Redirect::to('/admin_add_origin'); /* thêm xong trả về */
    }


    /* ẨN HIỆN */
    public function admin_display_origin($origin_id){
        $this->admin_test_login_admin();
        Origin::where('origin_id',$origin_id)->update(['origin_status'=>0]);
        session::put('message', "Ẩn xuất xứ thành công");
        return Redirect::to('/admin_list_origin');
    }
    public function admin_undisplay_origin($origin_id){
        $this->admin_test_login_admin();
        Origin::where('origin_id',$origin_id)->update(['origin_status'=>1]);
        session::put('message', "Hiện xuất xứ thành công");
        return Redirect::to('/admin_list_origin');
    }


    /* SỬA */
    public function admin_edit_origin($origin_id){
        $this->admin_test_login_admin();
        $edit_origin = Origin::where('origin_id',$origin_id)->get();
        $show_origin = view('admin.origin.admin_edit_origin')->with('edit_origin',$edit_origin); /* with(đặt tên,biên ở trên) đặt tên hồi đem qua for || biến gán dữ liệu cho đặt tên*/
        return view('admin_layout')->with('admin.origin.admin_edit_origin',$show_origin);
    }
    public function admin_update_edit_origin(Request $request, $origin_id){
        $this->admin_test_login_admin();
        $database = $request->all();
        $origin = Origin::find($origin_id); // tìm sản phẩm dựa trên id
        $origin->origin_name = $database['name_origin'];
        $origin->save();
        session::put('message',"Chỉnh sửa xuất xứ thành công.");
        return Redirect::to('/admin_list_origin');
    }


    /* XÓA */
    public function admin_delete_origin($origin_id){
        $this->admin_test_login_admin();
        Origin::find($origin_id)->delete();
        session::put('message',"Xóa xuất xứ thành công.");
        return Redirect::to('/admin_list_origin');
    }
//}END_ADMIN
}
