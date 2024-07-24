<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentNews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();

class CommentNewsController extends Controller
{
//CLIENT{
    public function client_submit_comment_news(Request $request){
        $data = $request->all();
        $comment_news = new CommentNews();
        $comment_news->news_id = $data['news_id'];
        $comment_news->comment_news_detail = $data['comment_news_detail'];
        $comment_news->client_id = Session::get('client_id');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $comment_news->created_at = now();
        $comment_news->save();
    }
    public function client_comment_news(Request $request){
        $news_id = $request->news_id;
        $show='';
        $comment_news = CommentNews::with('client')->where('news_id',$news_id)->where('client_id','!=',NULL)->get(); //where(csdl,biến ở trên) //lấy ra những cmt dựa vào product id trong csdl
        $reply_comment_news = CommentNews::get();
        foreach($comment_news as $key => $cmt){
            $show.='
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-start">
                        <img class="rounded-circle shadow-1-strong mr-3" src="'.URL('public/frontend/images/avatar.png').'" alt="avatar" width="50" height="50" />
                        <div class="flex-grow-1 flex-shrink-1">
                            <div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-1">
                                        <b>'.$cmt->client->client_name.'</b> <span class="small"> - '.date_format($cmt->created_at,'H:i:s d/m/Y').' - 2 hours ago</span>
                                    </p>
                                </div>
                                <p class="small mb-0">
                                    '.$cmt->comment_news_detail.'
                                </p>
                            </div>';
                            foreach($reply_comment_news as $key => $rep){
                                if($rep->comment_news_reply == $cmt->comment_news_id){
                                    $show.=
                                    '<div class="d-flex flex-start mt-4">
                                        <a class="mr-3" href="#">
                                            <img class="rounded-circle shadow-1-strong" src="'.URL('public/frontend/images/avatar.png').'" alt="avatar" width="50" height="50" />
                                        </a>
                                        <div class="flex-grow-1 flex-shrink-1">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="mb-1"><b>ImportedFruit</b> <span class="small">- '.date_format($rep->created_at,'H:i:s d/m/Y').'</span> </p>
                                                </div>
                                                <p class="small mb-0">'.$rep->comment_news_detail.'</p>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                            $show.='
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-5"><hr></div>';
        };
        echo $show;
    }
//}


//ADMIN{
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
    public function admin_list_comment_news(){
        $this->admin_test_login_admin();
        $reply_comment_news = CommentNews::get();
        $comment_news = CommentNews::with('client')->with('news')->where('client_id','!=',NULL)->orderBy('comment_news_id','DESC')->get();
        return view('admin.comment_news.admin_list_comment_news')
                ->with('comment_news',$comment_news)
                ->with('reply_comment_news',$reply_comment_news);
    }

    /* TRẢ LỜI */
    public function admin_reply_comment_news(Request $request){
        $data = $request->all();
        $comment_news = new CommentNews();
        $comment_news->comment_news_detail = $data['comment_news_detail'];
        $comment_news->news_id = $data['news_id'];
        $comment_news->comment_news_reply = $data['comment_news_id'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $comment_news->created_at = now();
        $comment_news->save();
    }

    /* XÓA */
    public function admin_delete_comment_news($comment_news_id){
        $this->admin_test_login_admin();
        $comment_news = CommentNews::find($comment_news_id);
        $comment_news->delete();
        session::put('message',"Xóa bình luận thành công.");
        return Redirect::to('/admin_list_comment_news');
    }
//}
}
