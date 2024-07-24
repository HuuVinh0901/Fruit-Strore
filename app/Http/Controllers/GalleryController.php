<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
session_start();
class GalleryController extends Controller
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

    /* THÊM */
    public function admin_add_gallery($product_id){
        $this->admin_test_login_admin();
        $id_product = $product_id;
        return view('admin.gallery.admin_add_gallery')->with('id_product',$id_product);
    }

    public function admin_submit_add_gallery(Request $request, $product_id){
        $get_image = $request->file('file'); //name bên kia file[]
        if($get_image){
            foreach($get_image as $show_image){ //cắt chuỗi hình ảnh từ mảng
                $get_name_image = $show_image -> getClientOriginalName();/*  lấy tên hình ảnh */
                $name_image = current(explode('.',$get_name_image));
                $image = $name_image.rand(0,99).'.'.$show_image->getClientOriginalExtension(); //getclient lấy đuôi mở rộng
                $show_image -> move('public/upload/gallery',$image);
                $gallery = new Gallery();
                $gallery->gallery_name = $image;
                $gallery->gallery_image = $image;
                $gallery->product_id = $product_id;
                $gallery->save();
            }
        }
        session::put('message',"Thêm thư viện ảnh thành công.");
        return Redirect()->back();
    }




    /* HIỂN THỊ */
    public function admin_list_gallery(Request $request){
        $product_id = $request->id_product;
        $gallery = Gallery::where('product_id',$product_id)->get();
        $gallery_count = $gallery->count(); //đếm bao nhiêu ảnh
        $show = '
            <form>
            '.csrf_field().'
                <div class="card">
                    <table id="datatable">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Hình ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
        ';
        if($gallery_count>0){
            $n=0;
            foreach($gallery as $key => $show_gallery){
                $n++;
                $show.='
                            <tr>
                                <td>'.$n.'</td>
                                <td contenteditable>'.$show_gallery->gallery_name.'</td>
                                <td>
                                    <img src="'.url('public/upload/gallery/'.$show_gallery->gallery_image).'" width="120px" height="120px">
                                </td>
                                <td>
                                    <button type="button" data-gallery_id="'.$show_gallery->gallery_id.'" class="delete_gallery border border-light bg-light">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <i class="fa-solid fa-x"></i>
                                    </button>
                                </td>
                            </tr>

            ';};
                $show.='
                        </tbody>
                    </table>
                </div>
            </form>';

        }else{
            $show.='
                    <tr>
                        <td colspan="4" class="text-center text-danger"><b>Sản phẩm này chưa có thư viện ảnh</b></td>
                    </tr>
                ';
        };
        $show.='
                        </tbody>
                    </table>
                </div>';
        echo $show;
    }

    /* XÓA */
    public function admin_delete_gallery(Request $request){
        $gallery_id = $request->gallery_id;
        $gallery = Gallery::find($gallery_id);
        unlink('public/upload/gallery/'.$gallery->gallery_image);
        $gallery->delete();
    }
}
