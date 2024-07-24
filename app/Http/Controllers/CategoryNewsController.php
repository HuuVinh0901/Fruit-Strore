<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CategoryNews;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryNewsController extends Controller
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
    public function admin_list_category_news(){
        $this->admin_test_login_admin();
        $list_category_news = CategoryNews::all();
        $show_category_news = view('admin.category_news.admin_list_category_news')
                                    ->with('list_category_news',$list_category_news); /* with(đặt tên,biên ở trên) đặt tên hồi đem qua for || biến gán dữ liệu cho đặt tên*/
        return view('admin_layout')
                ->with('admin.category_news.admin_list_category_news',$show_category_news);
    }


    /* THÊM */
    public function admin_add_category_news(){
        $this->admin_test_login_admin();
        return view('admin.category_news.admin_add_category_news');
    }
    public function admin_submit_add_category_news(Request $request){ /* request lấy yêu cầu dữ liệu */
        $this->admin_test_login_admin();
        $database = $request->all();
        $category_news = new CategoryNews(); // new class bên model thêm mới
        $category_news->category_news_name = $database['name_category_news'];
        $category_news->category_news_status = $database['status_category_news'];
        $category_news->save();
        session::put('message',"Thêm danh mục bài viết thành công.");
        return Redirect::to('/admin_add_category_news'); /* thêm xong trả về */
    }


    /* ẨN HIỆN */
    public function admin_display_category_news($category_news_id){
        $this->admin_test_login_admin();
        CategoryNews::where('category_news_id',$category_news_id)->update(['category_news_status'=>0]);
        session::put('message', "Ẩn danh mục thành công");
        return Redirect::to('/admin_list_category_news');
    }
    public function admin_undisplay_category_news($category_news_id){
        $this->admin_test_login_admin();
        CategoryNews::where('category_news_id',$category_news_id)->update(['category_news_status'=>1]);
        session::put('message', "Hiện danh mục thành công");
        return Redirect::to('/admin_list_category_news');
    }


    /* SỬA */
    public function admin_edit_category_news($category_news_id){
        $this->admin_test_login_admin();
        $edit_category_news = CategoryNews::where('category_news_id',$category_news_id)->get();
        $show_category_news = view('admin.category_news.admin_edit_category_news')->with('edit_category_news',$edit_category_news); /* with(đặt tên,biên ở trên) đặt tên hồi đem qua for || biến gán dữ liệu cho đặt tên*/
        return view('admin_layout')->with('admin.category_news.admin_edit_category_news',$show_category_news);
    }
    public function admin_update_edit_category_news(Request $request, $category_news_id){
        $this->admin_test_login_admin();
        $database = $request->all();
        $category_news = CategoryNews::find($category_news_id); // tìm sản phẩm dựa trên id
        $category_news->category_news_name = $database['name_category_news'];
        $category_news->save();
        session::put('message',"Chỉnh sửa danh mục bài viết thành công.");
        return Redirect::to('/admin_list_category_news');
    }


    /* XÓA */
    public function admin_delete_category_news($category_news_id){
        $this->admin_test_login_admin();
        CategoryNews::find($category_news_id)->delete();
        session::put('message',"Xóa danh mục bài viết thành công.");
        return Redirect::to('/admin_list_category_news');
    }
//}END_ADMIN


}
