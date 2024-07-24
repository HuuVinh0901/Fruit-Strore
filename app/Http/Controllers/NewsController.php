<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryProduct;
use App\Models\CategoryNews;
use App\Models\News;
use Illuminate\Support\Facades\Session;
session_start();

class NewsController extends Controller
{
    // START_ADMIN{
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
    public function admin_list_news(){
        $this->admin_test_login_admin();
        $list_news = News::with('category_news')->orderBy('created_at','DESC')->get();
        return view('admin.news.admin_list_news')
                ->with('list_news',$list_news);
    }

    /* CHI TIẾT */

    public function admin_detail_news($news_id){
        $this->admin_test_login_admin();
        $category_news = CategoryNews::where('category_news_status','1')->orderBy('category_news_id','desc')->get();
        $detail_news = News::with('category_news')->orderBy('news.news_id','desc')->where('news.news_id',$news_id)->get();
        return view('admin.news.admin_detail_news')
                    ->with('category_news',$category_news)
                    ->with('detail_news',$detail_news);
    }

    /* THÊM */
    public function admin_add_news(){
        $this->admin_test_login_admin();
        $category_news=CategoryNews::orderBy('category_news_id','desc')->get();
        return view('admin.news.admin_add_news')->with('category_news',$category_news); //tên khai báo,biến ở trên
    }
    public function admin_submit_add_news(Request $request){ /* request lấy yêu cầu dữ liệu */
        $this->admin_test_login_admin();
        $database = $request->all();
        $news = new News();
        $news->news_title = $database['title_news'];  //name=csdl
        $news->category_news_id = $database['category_news'];
        $news->news_summary = $database['summary_news'];
        $news->news_content = $database['content_news'];
        $news->news_status = $database['status_news'];

        $get_image = $request -> file('image_news');
        if($get_image){
            $get_name = $get_image -> getClientOriginalName();/*  lấy tên hình ảnh */
            $name_image = current(explode('.',$get_name));
            $image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); //getclient lấy đuôi mở rộng
            $get_image -> move('public/upload/news',$image);
            $news->news_image = $image;
            $news->save();
            $message = session::put('message',"Thêm bài viết thành công.");
            $request->$message;
            return Redirect::to('/admin_add_news');
        }
        $news->news_image ='';

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $news->created_at = now();
        $news->save();
        $message = session::put('message',"Thêm bài viết thành công.");
        $request->$message;
        return Redirect::to('/admin_add_news'); /* thêm xong trả về */
    }


    /* ẨN HIỆN */
    public function admin_display_news($news_id){
        $this->admin_test_login_admin();
        News::where('news_id',$news_id)->update(['news_status'=>0]); /* vào table điều kiện là id trong bảng csdl = tham số hàm -> update mảng [0,1] trạng thái (chưa hiểu)*/
        session::put('message', "Ẩn bài viết thành công");
        return Redirect::to('/admin_list_news');
    }
    public function admin_undisplay_news($news_id){
        $this->admin_test_login_admin();
        News::where('news_id',$news_id)->update(['news_status'=>1]); /* vào table điều kiện là id trong bảng csdl = tham số hàm -> update mảng [0,1] trạng thái (chưa hiểu)*/
        session::put('message', "Hiện bài viết thành công");
        return Redirect::to('/admin_list_news');
    }


    /* SỬA */
    public function admin_edit_news($news_id){
        $this->admin_test_login_admin();
        $category_news = CategoryNews::orderBy('category_news_id','desc')->get();
        $edit_news = News::where('news_id',$news_id)->get(); /* first lấy 1 cái */
        return view('admin.news.admin_edit_news')
                    ->with('edit_news',$edit_news)
                    ->with('category_news',$category_news);
    }
    public function admin_update_edit_news(Request $request, $news_id){
        $this->admin_test_login_admin();
        $database = $request->all();
        $news = News::find($news_id);
        $news->news_title = $database['title_news'];  //name=csdl
        $news->category_news_id = $database['category_news'];
        $news->news_summary = $database['summary_news'];
        $news->news_content = $database['content_news'];

        $get_image = $request -> file('image_news');
        if($get_image){
            $get_name = $get_image -> getClientOriginalName();/*  lấy tên hình ảnh */
            $name_image = current(explode('.',$get_name));
            $image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); //getclient lấy đuôi mở rộng
            $get_image -> move('public/upload/news',$image);
            $news->news_image = $image;
            $news->save();
            session::put('message',"Chỉnh sửa bài viết thành công.");
            return Redirect::to('/admin_list_news');
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $news->created_at = now();
        $news->save();
        session::put('message',"Chỉnh sửa bài viết thành công.");

        return Redirect::to('/admin_list_news');
    }


    /* XÓA */
    public function admin_delete_news($news_id){
        $this->admin_test_login_admin();
        $news = News::find($news_id);
        $news_image = $news->news_image;
        /* unlink('public/upload/news/'.$news_image); */ //xóa hình ảnh
        if($news_image){
            $image_path = 'public/upload/news/'.$news_image;
            unlink($image_path);
        }
        $news->delete(); /* first lấy 1 cái */
        session::put('message',"Xóa bài viết thành công.");
        return Redirect::to('/admin_list_news');
    }
//}END_ADMIN



    /* BÀI VIẾT */
    /* public function client_news_page(Request $request){
        $meta_description = "helllo";
        $meta_keyword = "Xin chào";
        $meta_title = "Imported Fruit - Bài viết";
        $link_canonical = $request->url();
        $category_product=DB::table('category_products')->where('category_product_status','1')->orderBy('category_product_id','desc')->get();
        return view('client.page.client_news_page')
            ->with('category_product',$category_product)
            ->with('meta_description',$meta_description)
            ->with('meta_keyword',$meta_keyword)
            ->with('meta_title',$meta_title)
            ->with('link_canonical',$link_canonical);
    } */


//CLIENT
    /* DANH SÁCH */
    public function client_list_news(Request $request){
        $url_canonical = $request->url();
        $category_product=CategoryProduct::where('category_product_status','1')->orderBy('category_product_id','desc')->get();
        $category_news=CategoryNews::where('category_news_status','1')->orderBy('category_news_id','desc')->get();
        $list_news = News::orderBy('created_at','DESC')->where('news_status','1')->take(3)->get();
        $new_news = News::orderBy('news.news_id','desc')->take(3)->get();//mới
        return view('client.news.client_list_news')
                ->with('category_product',$category_product)
                ->with('category_news',$category_news)
                ->with('list_news',$list_news)
                ->with('new_news',$new_news)
                ->with('url_canonical',$url_canonical);
    }
    /* CHI TIẾT */

    public function client_detail_news(Request $request,$news_id){
        $url_canonical = $request->url();
        $category_product=CategoryProduct::where('category_product_status','1')->orderBy('category_product_id','desc')->get();
        $category_news=CategoryNews::where('category_news_status','1')->orderBy('category_news_id','desc')->get();
        $list_news = News::orderBy('news.created_at','DESC')->take(3)->get();
        $detail_news = News::orderBy('news.created_at','DESC')->where('news.news_id',$news_id)->get();

        foreach ($detail_news as $key => $value){
            $category_id = $value->category_news_id;
        }
        $related_news = News::orderBy('created_at','DESC')
                            ->where('category_news_id',$category_id)
                            ->where('news_status','1')                           //hiện những cái không ẩn
                            ->whereNotIn('news.news_id',[$news_id])   //whereNotIn lấy giống danh mục và trừ ra cái có id = nó
                            ->get();
        return view('client.news.client_detail_news')
                    ->with('category_product',$category_product)
                    ->with('category_news',$category_news)
                    ->with('detail_news',$detail_news)
                    ->with('list_news',$list_news)
                    ->with('related_news',$related_news)
                    ->with('url_canonical',$url_canonical);
    }

    /* DNAH SÁCH THEO ID */
    public function client_category_news(Request $request, $category_news_id){
        $url_canonical = $request->url();
        $category_product=CategoryProduct::where('category_product_status','1')->orderBy('category_product_id','desc')->get();
        $category_news=CategoryNews::where('category_news_status','1')->orderBy('category_news_id','desc')->get();
        $list_news = News::orderBy('created_at','DESC')->where('news_status','1')->where('category_news_id',$category_news_id)->take(3)->get();
        $new_news = News::orderBy('news.news_id','asc')->take(3)->get();//mới
        return view('client.news.client_list_news')
                ->with('category_product',$category_product)
                ->with('category_news',$category_news)
                ->with('list_news',$list_news)
                ->with('new_news',$new_news)
                ->with('url_canonical',$url_canonical);
    }

}
