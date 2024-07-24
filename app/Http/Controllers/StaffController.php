<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use App\Models\AdminRole;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

session_start();
class StaffController extends Controller
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

    //cấp tài khoản nhân viên
    public function admin_create_staff(){
        $this->admin_test_login_admin();
        return view('admin.staff.admin_create_staff');
    }
    public function admin_submit_create_staff(Request $request){
        $this->admin_test_login_admin();
        $this->vadilation($request);
        $data = $request->all();

        $staff = new Admin();
        $staff->admin_name = $data['staff_name'];
        $staff->admin_email = $data['staff_email'];
        $staff->admin_phone = $data['staff_phone'];
        $staff->admin_password = md5($data['staff_password']);
        $staff->save();
        return redirect('/admin_list_staff')->with('message','Tạo tài khoản thành công');
    }

    //nhân viên đăng nhập
    public function admin_login_staff(){
        return view('admin.staff.admin_login_staff');
    }

    public function admin_submit_login_staff(Request $request){
        $this->validate($request,[
            'staff_email' => 'required|email|unique:client,client_email',
            'staff_password' => 'required|min:8',
        ]);
        /* $data = $request->all(); */
        if(Auth::attempt(['admin_email'=>$request->staff_email,'admin_password'=>$request->staff_password])){ //$request->input['staff_email']
            return redirect('/admin_revenue_statistical');
        } else{
            return redirect('/admin_login_staff')->with('message','Tài khoản hoặc mật khẩu không đúng');
        }
    }

    //đăng xuất
    public function admin_logout_staff(){
        $this->admin_test_login_admin();
        Auth::logout();
        //hủy session
        return redirect('/admin_login_staff')->with('message','Đã đăng xuất');
    }


    //kiểm tra lỗi
    public function vadilation(Request $request){
        $this->admin_test_login_admin();
        return $this->validate($request,[
            'staff_name' => 'required|min:3|max:30',
            'staff_email' => 'required|email|unique:client,client_email',
            'staff_phone' => 'required|digits:10,11|starts_with:0',
            'staff_password' => 'required|min:8',
        ]);
    }

    //danh sách nhân viên
    public function admin_list_staff(){
        $this->admin_test_login_admin();
        $list_staff = Admin::with('role')->whereNotIn('admin_id', [3, 9])->orderBy('admin_id','DESC')->get(); //get thay bằng paginate(5) 5 cái 1 trang
        return view('admin.staff.admin_list_staff')->with('list_staff',$list_staff);
    }

    //cấp quyền nhân viên
    public function admin_allow_role_staff(Request $request){
        $this->admin_test_login_admin();
        /* $data = $request->all(); */
        $staff = Admin::where('admin_email',$request->admin_email)->first();
        $staff->role()->detach(); //detach bỏ chọn quyền
        if($request->admin_role){ //name
            $staff->role()->attach(Role::where('role_name','admin')->first());     //name csdl
        }
        if($request->nvbh_role){
            $staff->role()->attach(Role::where('role_name','Nhân viên bán hàng')->first());
        }
        if($request->nvk_role){
            $staff->role()->attach(Role::where('role_name','Nhân viên kho')->first());
        }
        if($request->nvgh_role){
            $staff->role()->attach(Role::where('role_name','Nhân viên giao hàng')->first());
        }
        return redirect()->back()->with('message','Cấp quyền thành công');
    }

    //xóa nhân viên
    public function admin_delete_staff($admin_id){ //không xóa chính mình
        if(Auth::id()==$admin_id){
            return redirect()->back()->with('message','Bạn không được xóa chính mình');
        }
        $admin = Admin::find($admin_id);
        if($admin){ //xóa luôn quyền ở admin_role
            $admin->role()->detach();
            $admin->delete();
        }
        return redirect()->back()->with('message','Xóa nhân viên thành công');
    }
}
