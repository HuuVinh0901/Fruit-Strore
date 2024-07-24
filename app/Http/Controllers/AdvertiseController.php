<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;
use App\Models\Advertise;

session_start();

class AdvertiseController extends Controller
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

    //danh sách
    public function admin_list_advertise(){
        $this->admin_test_login_admin();
        $list_advertise = Advertise::orderBy('advertise_id','DESC')->get();
        return view('admin.advertise.admin_list_advertise')->with('list_advertise',$list_advertise);
    }

    public function admin_add_advertise(){
        $this->admin_test_login_admin();
        return view('admin.advertise.admin_add_advertise'); //tên khai báo,biến ở trên
    }
    public function admin_submit_add_advertise(Request $request){ /* request lấy yêu cầu dữ liệu */
        $this->admin_test_login_admin();
        $database = $request->all();
        $get_image = $request -> file('image_advertise');
        if($get_image){
            $get_name = $get_image -> getClientOriginalName();/*  lấy tên hình ảnh */
            $name_image = current(explode('.',$get_name));
            $image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); //getclient lấy đuôi mở rộng
            $get_image -> move('public/upload/advertise',$image);

            $advertise = new Advertise();
            $advertise->advertise_name = $database['name_advertise'];
            $advertise->advertise_image = $image;
            $advertise->advertise_detail = $database['detail_advertise'];
            $advertise->advertise_status = $database['status_advertise'];

            $advertise->save();
            session::put('message',"Thêm quảng cáo thành công.");
            return Redirect::to('/admin_add_advertise');
        }else{
            Session::put('message','Vui lòng điền đầy đủ thông tin');
            return Redirect::to('/admin_add_advertise');
        }
    }


    /* ẨN HIỆN */
    public function admin_display_advertise($advertise_id){
        $this->admin_test_login_admin();
        Advertise::where('advertise_id',$advertise_id)->update(['advertise_status'=>0]); /* vào table điều kiện là id trong bảng csdl = tham số hàm -> update mảng [0,1] trạng thái (chưa hiểu)*/
        session::put('message', "Ẩn quảng cáo thành công");
        return Redirect::to('/admin_list_advertise');
    }
    public function admin_undisplay_advertise($advertise_id){
        $this->admin_test_login_admin();
        Advertise::where('advertise_id',$advertise_id)->update(['advertise_status'=>1]); /* vào table điều kiện là id trong bảng csdl = tham số hàm -> update mảng [0,1] trạng thái (chưa hiểu)*/
        session::put('message', "Hiện quảng cáo thành công");
        return Redirect::to('/admin_list_advertise');
    }

    public function admin_edit_advertise($advertise_id){
        $this->admin_test_login_admin();
        $edit_advertise = Advertise::where('advertise_id',$advertise_id)->get(); /* first lấy 1 cái */
        return view('admin.advertise.admin_edit_advertise')->with('edit_advertise',$edit_advertise);
    }
    public function admin_update_edit_advertise(Request $request, $advertise_id){
        $this->admin_test_login_admin();
        $database = $request->all();
        $advertise = Advertise::find($advertise_id);
        $advertise->advertise_name = $database['name_advertise'];  //csdl = name
        $advertise->advertise_detail = $database['detail_advertise'];
        $get_image = $request -> file('image_advertise');
        if($get_image){
            $get_name = $get_image -> getClientOriginalName();/*  lấy tên hình ảnh */
            $name_image = current(explode('.',$get_name));
            $image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); //getclient lấy đuôi mở rộng
            $get_image -> move('public/upload/advertise',$image);
            $advertise->advertise_image = $image;
            $advertise->save();
            session::put('message',"Chỉnh sửa quảng cáo thành công.");
            return Redirect::to('/admin_list_advertise');
        }
        $advertise->save();
        session::put('message',"Chỉnh sửa quảng cáo thành công.");

        return Redirect::to('/admin_list_advertise');
    }


    /* XÓA */
    public function admin_delete_advertise($advertise_id){
        $this->admin_test_login_admin();
        Advertise::where('advertise_id',$advertise_id)->delete(); /* first lấy 1 cái */
        session::put('message',"Xóa quảng cáo thành công.");
        return Redirect::to('/admin_list_advertise');
    }
}
