<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Origin;
use App\Models\CategoryProduct;
use App\Models\Gallery;
use App\Models\Cost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
session_start();

class ProductController extends Controller
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
    public function admin_list_product(){
        $this->admin_test_login_admin();
        $list_product = Product::with('category_product')->with('origin')->orderBy('product_id','desc')->get();
        return view('admin.product.admin_list_product')->with('list_product',$list_product);
    }

    /* CHI TIẾT */
    public function admin_detail_product($product_id){
        $this->admin_test_login_admin();
        $detail_product = Product::where('product_id',$product_id)->get();
        foreach ($detail_product as $key => $value){
            $product_id = $value->product_id;
        }
        return view('admin.product.admin_detail_product')
                    ->with('detail_product',$detail_product);
    }


    /* THÊM */
    public function admin_add_product(){
        $this->admin_test_login_admin();
        $category_product=CategoryProduct::orderBy('category_product_id','desc')->get();
        $origin=Origin::orderBy('origin_id','desc')->get();
        return view('admin.product.admin_add_product')->with('category_product',$category_product)->with('origin',$origin); //tên khai báo,biến ở trên
    }
    public function admin_submit_add_product(Request $request){ /* request lấy yêu cầu dữ liệu */
        $this->admin_test_login_admin();
        $database = array();
        $product_price = filter_var($request->price_product,FILTER_SANITIZE_NUMBER_INT);
        $product_cost = filter_var($request->cost_product,FILTER_SANITIZE_NUMBER_INT);
        $database['product_name'] = $request->name_product;
        $database['product_summary'] = $request->summary_product;
        $database['product_tag'] = $request->tag_product;
        $database['product_detail'] = $request->detail_product;
        $database['product_packing'] = $request->packing_product;
        $database['product_cost'] = $product_cost;
        $database['product_price'] = $product_price;
        $database['product_amount'] = $request->amount_product;
        $database['product_sold'] = 0;
        $database['product_status'] = 0;
        $database['category_product_id'] = $request->category_product;
        $database['origin_id'] = $request->orign;

        $get_image = $request -> file('image_product');

        $path_product = 'upload/product/';
        $path_gallery = 'upload/gallery/';

        if($get_image){
            $get_name = $get_image -> getClientOriginalName();/*  lấy tên hình ảnh */
            $name_image = current(explode('.',$get_name));
            $image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); //getclient lấy đuôi mở rộng
            $get_image->move(public_path($path_product),$image);
            File::copy(public_path($path_product.$image), public_path($path_gallery.$image));
            $database['product_image'] = $image;
        }
        $product_id = DB::table('product')->insertGetId($database);
        $gallery = new Gallery();
        $gallery->gallery_image = $image;
        $gallery->gallery_name = $image;
        $gallery->product_id = $product_id;
        $gallery->save();
        session::put('message',"Thêm sản phẩm thành công.");
        return Redirect::to('/admin_add_product'); /* thêm xong trả về */
    }


    /* ẨN HIỆN */
    public function admin_display_product($product_id){
        $this->admin_test_login_admin();
        Product::where('product_id',$product_id)->update(['product_status'=>0]); /* vào table điều kiện là id trong bảng csdl = tham số hàm -> update mảng [0,1] trạng thái (chưa hiểu)*/
        session::put('message', "Ẩn sản phẩm thành công");
        return Redirect::to('/admin_list_product');
    }
    public function admin_undisplay_product($product_id){
        $this->admin_test_login_admin();
        Product::where('product_id',$product_id)->update(['product_status'=>1]); /* vào table điều kiện là id trong bảng csdl = tham số hàm -> update mảng [0,1] trạng thái (chưa hiểu)*/
        session::put('message', "Hiện sản phẩm thành công");
        return Redirect::to('/admin_list_product');
    }


    /* SỬA */
    public function admin_edit_product($product_id){
        $this->admin_test_login_admin();
        $category_product = CategoryProduct::orderBy('category_product_id','desc')->get();
        $origin = Origin::orderBy('origin_id','desc')->get();
        $edit_product = Product::where('product_id',$product_id)->get(); /* first lấy 1 cái */
        return view('admin.product.admin_edit_product')
                    ->with('edit_product',$edit_product)
                    ->with('category_product',$category_product)
                    ->with('origin',$origin);
    }
    public function admin_update_edit_product(Request $request, $product_id){
        $database = array();
        $product_price = filter_var($request->price_product,FILTER_SANITIZE_NUMBER_INT);                                        /* tự đặt biến */
        $product_cost = filter_var($request->cost_product,FILTER_SANITIZE_NUMBER_INT);                                        /* tự đặt biến */
        $database['product_name'] = $request->name_product;
        $database['product_summary'] = $request->summary_product;
        $database['product_tag'] = $request->tag_product;
        $database['product_detail'] = $request->detail_product;
        $database['product_packing'] = $request->packing_product;
        $database['product_cost'] = $product_cost;
        $database['product_price'] = $product_price;
        $database['product_amount'] = $request->amount_product;
        $database['category_product_id'] = $request->category_product; /* tên CSDL = name */
        $database['origin_id'] = $request->origin; /* tên CSDL = name */

        $get_image = $request -> file('image_product');

        $path_product = 'upload/product/';
        $path_gallery = 'upload/gallery/';

        if($get_image){
            $get_name = $get_image -> getClientOriginalName();/*  lấy tên hình ảnh */
            $name_image = current(explode('.',$get_name));
            $image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); //getclient lấy đuôi mở rộng
            $get_image->move(public_path($path_product),$image);
            File::copy(public_path($path_product.$image), public_path($path_gallery.$image));
            $database['product_image'] = $image;
        }
        DB::table('product')->where('product_id',$product_id)->update($database); /* csdl = ts hàm */
        session::put('message',"Chỉnh sửa sản phẩm thành công.");
        return Redirect::to('/admin_list_product');
    }


    /* XÓA */
    public function admin_delete_product($product_id){
        $this->admin_test_login_admin();
        $product = Product::find($product_id); /* first lấy 1 cái */
        $product_image = $product->product_image;
        /* if($product_image){
            $image_path_product = 'public/upload/product/'.$product_image;
            unlink($image_path_product);
            $image_path_gallery = 'public/upload/gallery/'.$product_image;
            unlink($image_path_gallery);
        } */
        $product->delete();
        session::put('message',"Xóa sản phẩm thành công.");
        return Redirect::to('/admin_list_product');
    }


    /* Thêm giá khuyến mãi */
    public function admin_add_sale_product($product_id){
        $sale_product = Product::where('product_id',$product_id)->get();
        foreach ($sale_product as $key => $value){
            $product_id = $value->product_id;
        }
        $cost = Cost::with('product')->where('product_id',$product_id)->get();
        return view('admin.product.admin_add_sale_product')->with('sale_product',$sale_product)->with('cost',$cost);
    }
    public function admin_add_submit_sale_product(Request $request, $product_id){
        $product = Product::find($product_id);
        $product->product_sale =  filter_var($request->sale_product,FILTER_SANITIZE_NUMBER_INT);
        $product->save();
        return Redirect::to('/admin_list_product')->with('message','Thêm giá khuyến mãi thành công');
    }

    /* sửa giá khuyến mãi */
    public function admin_edit_sale_product($product_id){
        $sale_product = Product::where('product_id',$product_id)->get();
        foreach ($sale_product as $key => $value){
            $product_id = $value->product_id;
        }
        $cost = Cost::with('product')->where('product_id',$product_id)->get();
        return view('admin.product.admin_edit_sale_product')->with('sale_product',$sale_product)->with('cost',$cost);
    }
    public function admin_edit_update_sale_product(Request $request, $product_id){
        $product = Product::find($product_id);
        $product->product_sale =  filter_var($request->sale_product,FILTER_SANITIZE_NUMBER_INT);
        $product->save();
        return Redirect::to('/admin_list_product')->with('message','Chỉnh sửa giá khuyến mãi thành công');
    }

    /* xóa giá khuyến mãi */
    public function admin_delete_sale_product($product_id){
        $this->admin_test_login_admin();
        $product = Product::find($product_id);
        $product->product_sale = NULL;
        $product->save();
        return Redirect::to('/admin_list_product')->with('message',"Xóa giá khuyến mãi thành công.");
    }


    /* Thêm số lượng sản phẩm */
    public function admin_add_amount_product(Request $request){
        $this->admin_test_login_admin();
        $data = $request->all();
        $product = Product::find($data['product_id']);
        $product_amount =$data['product_amount'] + $product->product_amount; //data bên ajax logout
        $product->product_amount = $product_amount;
        $product->save();
    }



//}END_ADMIN


//START_CLIENT{

    // DANH SÁCH SẢN PHẨM
    public function client_list_product(Request $request){
        $url_canonical = $request->url();
        $min_product_price = Product::where('product_status',1)->min('product_price');
        $max_product_price = Product::where('product_status',1)->max('product_price');
        $min_amount = 0;
        $max_amount = $max_product_price + 20000;
        if(isset($_GET['client_sort_product'])){
            $client_sort_product = $_GET['client_sort_product'];
            if($client_sort_product == 'decrease_price'){
                $product = Product::where('product_status','1')
                                    ->orderBy('product_price','DESC')
                                    ->paginate(6)->appends(request()->query()); //chuyển qua qua hai sẽ không bị mất bộ lọc
            }elseif($client_sort_product == 'increase_price'){
                $product = Product::where('product_status','1')
                                    ->orderBy('product_price','ASC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'za_name_product'){
                $product = Product::where('product_status','1')
                                    ->orderBy('product_name','DESC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'az_name_product'){
                $product = Product::where('product_status','1')
                                    ->orderBy('product_name','ASC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'new_name_product'){
                $product = Product::where('product_status','1')
                                    ->orderBy('product_id','DESC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'old_name_product'){
                $product = Product::where('product_status','1')
                                    ->orderBy('product_id','ASC')
                                    ->paginate(6)->appends(request()->query());
            }
        }elseif(isset($_GET['min_amount']) && ($_GET['max_amount'])){
            $min_price = $_GET['min_amount'];
            $max_price = $_GET['max_amount'];
            $product=Product::where('product_status','1')
                                ->whereBetween('product_price',[$min_price,$max_price])
                                ->orderBy('product_id','desc')
                                ->paginate(6)->appends(request()->query());
        }else{
            $product=Product::where('product_status','1')->orderBy('product_id','asc')->paginate(6);
        }
        //xuất xứ
        $origin=Origin::where('origin_status','1')->orderBy('origin_id','desc')->get();
        //mới nhất
        $product_news=Product::where('product_status','1')->orderBy('product_id','desc')->limit(3)->get();
        //bán chạy
        $product_max=Product::orderBy('product_sold', 'desc')->take(3)->get();

        return view('client.product.client_list_product')
                ->with('product',$product)
                ->with('min_product_price',$min_product_price)
                ->with('max_product_price',$max_product_price)
                ->with('min_amount',$min_amount)
                ->with('max_amount',$max_amount)
                ->with('origin',$origin)
                ->with('product_news',$product_news)
                ->with('product_max',$product_max)
                ->with('url_canonical',$url_canonical);
    }
    /* CHI TIẾT SẢN PHẨM */
    public function client_detail_product(Request $request,$product_id){
        $url_canonical = $request->url();
        $category_product = CategoryProduct::where('category_product_status','1')->orderBy('category_product_id','desc')->get();

        $detail_product = Product::with('category_product')->orderBy('product_id','desc')->where('product_id',$product_id)->get();
        foreach ($detail_product as $key => $value){
            $category_id = $value->category_product_id;
            $product_id = $value->product_id;
        }
        $gallery = Gallery::where('product_id',$product_id)->take(4)->get();
        $related_product = Product::with('category_product')
                                    ->orderBy('product_id','desc')
                                    ->where('category_product_id',$category_id)
                                    ->where('product_status','1')                           //hiện những cái không ẩn
                                    ->whereNotIn('product.product_id',[$product_id])   //whereNotIn lấy giống danh mục và trừu ra cái có id = nó
                                    ->take(8)->get();
        return view('client.product.client_detail_product')
                    ->with('category_product',$category_product)
                    ->with('detail_product',$detail_product)
                    ->with('gallery',$gallery)
                    ->with('related_product',$related_product)
                    ->with('url_canonical',$url_canonical);
    }

    //danh sách theo danh mục
    public function client_category_product(Request $request, $category_product_id){
        $url_canonical = $request->url();
        $min_product_price_category = Product::with('category_product')
                                        ->where('product_status',1)
                                        ->where('category_product_id',$category_product_id)
                                        ->min('product_price');
        $max_product_price_category = Product::with('category_product')
                                        ->where('product_status',1)
                                        ->where('category_product_id',$category_product_id)
                                        ->max('product_price');
        $min_amount_category = 0;
        $max_amount_category = $max_product_price_category + 20000;
        if(isset($_GET['client_sort_product'])){
            $client_sort_product = $_GET['client_sort_product'];
            if($client_sort_product == 'decrease_price'){
                $id_category_product = Product::with('category_product')
                                    ->where('product_status',1)
                                    ->where('category_product_id',$category_product_id)
                                    ->orderBy('product_price','DESC')
                                    ->paginate(6)->appends(request()->query()); //chuyển qua qua hai sẽ không bị mất bộ lọc
            }elseif($client_sort_product == 'increase_price'){
                $id_category_product = Product::with('category_product')
                                    ->where('category_product_id',$category_product_id)
                                    ->where('product_status',1)
                                    ->orderBy('product_price','ASC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'za_name_product'){
                $id_category_product = Product::with('category_product')
                                    ->where('category_product_id',$category_product_id)
                                    ->where('product_status',1)
                                    ->orderBy('product_name','DESC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'az_name_product'){
                $id_category_product = Product::with('category_product')
                                    ->where('category_product_id',$category_product_id)
                                    ->where('product_status',1)
                                    ->orderBy('product_name','ASC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'new_name_product'){
                $id_category_product = Product::with('category_product')
                                    ->where('category_product_id',$category_product_id)
                                    ->where('product_status','1')
                                    ->orderBy('product_id','DESC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'old_name_product'){
                $id_category_product = Product::with('category_product')
                                    ->where('category_product_id',$category_product_id)
                                    ->where('product_status','1')
                                    ->orderBy('product_id','ASC')
                                    ->paginate(6)->appends(request()->query());
            }
        }elseif(isset($_GET['min_amount_category']) && ($_GET['max_amount_category'])){
            $min_price_category = $_GET['min_amount_category'];
            $max_price_category = $_GET['max_amount_category'];
            $id_category_product=Product::with('category_product')
                                        ->where('product_status',1)
                                        ->where('category_product_id',$category_product_id)
                                        ->whereBetween('product_price',[$min_price_category,$max_price_category])
                                        ->paginate(6)->appends(request()->query());
        }else{
            $id_category_product=Product::with('category_product')
                                            ->where('category_product_id',$category_product_id)
                                            ->where('product_status',1)
                                            ->paginate(6);
        }

        $name_category_product=CategoryProduct::where('category_product_id',$category_product_id)->get();

        //danh sách danh mục
        $category_product=CategoryProduct::where('category_product_status','1')->orderBy('category_product_id','desc')->get();
        //xuát xứ
        $origin=Origin::where('origin_status','1')->orderBy('origin_id','desc')->get();
        //mới nhất
        $product_news=Product::where('product_status','1')->orderBy('product_id','desc')->limit(3)->get();
        //bán chạy
        $product_max=Product::orderBy('product_sold', 'desc')->take(3)->get();

        return view('client.product.client_category_product')
                    ->with('id_category_product',$id_category_product)
                    ->with('name_category_product',$name_category_product)
                    ->with('category_product',$category_product)
                    ->with('origin',$origin)
                    ->with('min_product_price_category',$min_product_price_category)
                    ->with('max_product_price_category',$max_product_price_category)
                    ->with('min_amount_category',$min_amount_category)
                    ->with('max_amount_category',$max_amount_category)
                    ->with('product_news',$product_news)
                    ->with('product_max',$product_max)
                    ->with('url_canonical',$url_canonical);
    }

    //Danh sách theo xuất xứ
    public function client_origin_product(Request $request, $origin_id){
        $url_canonical = $request->url();
        $min_product_price_origin = Product::with('origin')
                                        ->where('product_status',1)
                                        ->where('origin_id',$origin_id)
                                        ->min('product_price');
        $max_product_price_origin = Product::with('origin')
                                        ->where('product_status',1)
                                        ->where('origin_id',$origin_id)
                                        ->max('product_price');
        $min_amount_origin = 0;
        $max_amount_origin = $max_product_price_origin + 20000;
        if(isset($_GET['client_sort_product'])){
            $client_sort_product = $_GET['client_sort_product'];
            if($client_sort_product == 'decrease_price'){
                $id_origin = Product::with('origin')
                                    ->where('product_status',1)
                                    ->where('origin_id',$origin_id)
                                    ->orderBy('product_price','DESC')
                                    ->paginate(6)->appends(request()->query()); //chuyển qua qua hai sẽ không bị mất bộ lọc
            }elseif($client_sort_product == 'increase_price'){
                $id_origin = Product::with('origin')
                                    ->where('origin_id',$origin_id)
                                    ->where('product_status',1)
                                    ->orderBy('product_price','ASC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'za_name_product'){
                $id_origin = Product::with('origin')
                                    ->where('origin_id',$origin_id)
                                    ->where('product_status',1)
                                    ->orderBy('product_name','DESC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'az_name_product'){
                $id_origin = Product::with('origin')
                                    ->where('origin_id',$origin_id)
                                    ->where('product_status',1)
                                    ->orderBy('product_name','ASC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'new_name_product'){
                $id_origin = Product::with('origin')
                                    ->where('origin_id',$origin_id)
                                    ->where('product_status','1')
                                    ->orderBy('product_id','DESC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'old_name_product'){
                $id_origin = Product::with('origin')
                                    ->where('origin_id',$origin_id)
                                    ->where('product_status','1')
                                    ->orderBy('product_id','ASC')
                                    ->paginate(6)->appends(request()->query());
            }
        }elseif(isset($_GET['min_amount_origin']) && ($_GET['max_amount_origin'])){
            $min_price_origin = $_GET['min_amount_origin'];
            $max_price_origin = $_GET['max_amount_origin'];
            $id_origin=Product::with('origin')
                                    ->where('origin_id',$origin_id)
                                    ->where('product_status','1')
                                    ->whereBetween('product_price',[$min_price_origin,$max_price_origin])
                                    ->paginate(6)->appends(request()->query());
        }else{
            $id_origin=Product::with('origin')
                                            ->where('origin_id',$origin_id)
                                            ->where('product_status',1)
                                            ->paginate(6);
        }

        $name_origin=Origin::where('origin_id',$origin_id)->get();

        //xuát xứ
        $origin=Origin::where('origin_status','1')->orderBy('origin_id','desc')->get();
        //mới nhất
        $product_news=Product::where('product_status','1')->orderBy('product_id','desc')->limit(3)->get();
        //bán chạy
        $product_max=Product::orderBy('product_sold', 'desc')->take(3)->get();

        return view('client.product.client_origin_product')
                    ->with('id_origin',$id_origin)
                    ->with('name_origin',$name_origin)
                    ->with('origin',$origin)
                    ->with('min_product_price_origin',$min_product_price_origin)
                    ->with('max_product_price_origin',$max_product_price_origin)
                    ->with('min_amount_origin',$min_amount_origin)
                    ->with('max_amount_origin',$max_amount_origin)
                    ->with('product_news',$product_news)
                    ->with('product_max',$product_max)
                    ->with('url_canonical',$url_canonical);
    }

    //Danh sách theo giá
    public function client_price_product(Request $request, $product_price){
        $url_canonical = $request->url();
        $price_product=Product::where('product_price', $product_price)->orderBy('product_id','desc')->paginate(6);

        if(isset($_GET['client_sort_product'])){
            $client_sort_product = $_GET['client_sort_product'];
            if($client_sort_product == 'za_name_product'){
                $price_product = Product::where('product_price', $product_price)
                                    ->where('product_status','1')
                                    ->orderBy('product_name','DESC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'az_name_product'){
                $price_product = Product::where('product_price', $product_price)
                                    ->where('product_status','1')
                                    ->orderBy('product_name','ASC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'new_name_product'){
                $price_product = Product::where('product_price', $product_price)
                                    ->where('product_status','1')
                                    ->orderBy('product_id','DESC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'old_name_product'){
                $price_product = Product::where('product_price', $product_price)
                                    ->where('product_status','1')
                                    ->orderBy('product_id','ASC')
                                    ->paginate(6)->appends(request()->query());
            }
        }

        $price=Product::where('product_price', $product_price)->limit(1)->get();

        //danh sách danh mục
        $category_product=CategoryProduct::where('category_product_status','1')->orderBy('category_product_id','desc')->get();
        //xuất xứ
        $origin=Origin::where('origin_status','1')->orderBy('origin_id','desc')->get();
        //mới nhất
        $product_news=Product::where('product_status','1')->orderBy('product_id','desc')->limit(3)->get();
        //bán chạy
        $product_max=Product::orderBy('product_sold', 'desc')->take(3)->get();

        return view('client.product.client_price_product')
                ->with('price_product',$price_product)
                ->with('price',$price)
                ->with('category_product',$category_product)
                ->with('origin',$origin)
                ->with('product_news',$product_news)
                ->with('product_max',$product_max)
                ->with('url_canonical',$url_canonical);
    }

    /* tag */
    public function client_tag_product(Request $request, $product_tag){

        $url_canonical = $request->url();

        $tag = str_replace("-"," ",$product_tag);

        $min_product_price_tag = Product::where('product_status',1)
                                        ->where('product_name','LIKE','%'.$tag.'%')
                                        ->orWhere('product_tag','LIKE','%'.$tag.'%')
                                        ->min('product_price');
        $max_product_price_tag = Product::where('product_status',1)
                                        ->where('product_name','LIKE','%'.$tag.'%')
                                        ->orWhere('product_tag','LIKE','%'.$tag.'%')
                                        ->max('product_price');
        $min_amount_tag = 0;
        $max_amount_tag = $max_product_price_tag + 20000;

        if(isset($_GET['client_sort_product'])){
            $client_sort_product = $_GET['client_sort_product'];
            if($client_sort_product == 'decrease_price'){
                $list_product_tag = Product::where('product_status',1)
                                    ->where('product_name','LIKE','%'.$tag.'%')
                                    ->orWhere('product_tag','LIKE','%'.$tag.'%')
                                    ->orderBy('product_price','DESC')
                                    ->paginate(6)->appends(request()->query()); //chuyển qua qua hai sẽ không bị mất bộ lọc
            }elseif($client_sort_product == 'increase_price'){
                $list_product_tag = Product::where('product_status',1)
                                    ->where('product_name','LIKE','%'.$tag.'%')
                                    ->orWhere('product_tag','LIKE','%'.$tag.'%')
                                    ->orderBy('product_price','ASC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'za_name_product'){
                $list_product_tag = Product::where('product_status',1)
                                    ->where('product_name','LIKE','%'.$tag.'%')
                                    ->orWhere('product_tag','LIKE','%'.$tag.'%')
                                    ->orderBy('product_name','DESC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'az_name_product'){
                $list_product_tag = Product::where('product_status',1)
                                    ->where('product_name','LIKE','%'.$tag.'%')
                                    ->orWhere('product_tag','LIKE','%'.$tag.'%')
                                    ->orderBy('product_name','ASC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'new_name_product'){
                $list_product_tag = Product::where('product_status','1')
                                    ->where('product_name','LIKE','%'.$tag.'%')
                                    ->orWhere('product_tag','LIKE','%'.$tag.'%')
                                    ->orderBy('product_id','DESC')
                                    ->paginate(6)->appends(request()->query());
            }elseif($client_sort_product == 'old_name_product'){
                $list_product_tag = Product::where('product_status','1')
                                    ->where('product_name','LIKE','%'.$tag.'%')
                                    ->orWhere('product_tag','LIKE','%'.$tag.'%')
                                    ->orderBy('product_id','ASC')
                                    ->paginate(6)->appends(request()->query());
            }

        }elseif(isset($_GET['min_amount_tag']) && ($_GET['max_amount_tag'])){
            $min_price_tag = $_GET['min_amount_tag'];
            $max_price_tag = $_GET['max_amount_tag'];
            $list_product_tag=Product::where('product_status','1')
                                        ->where('product_name','LIKE','%'.$tag.'%')
                                        ->orWhere('product_tag','LIKE','%'.$tag.'%')
                                        ->whereBetween('product_price',[$min_price_tag,$max_price_tag])
                                        ->paginate(6)->appends(request()->query());
        }else{
            $list_product_tag = Product::where('product_status',1)
                                        ->where('product_name','LIKE','%'.$tag.'%')
                                        ->orWhere('product_tag','LIKE','%'.$tag.'%') //đúng 1 trong 2 product_name hay product_tag vẫn được
                                        ->paginate(6);
        }

        //danh sách danh mục
        $category_product=CategoryProduct::where('category_product_status','1')->orderBy('category_product_id','desc')->get();
        //xuất xứ
        $origin=Origin::where('origin_status','1')->orderBy('origin_id','desc')->get();
        //mới nhất
        $product_news=Product::where('product_status','1')->orderBy('product_id','desc')->limit(3)->get();
        //bán chạy
        $product_max=Product::orderBy('product_sold', 'desc')->take(3)->get();

        return view('client.product.client_tag_product')
                ->with('category_product',$category_product)
                ->with('origin',$origin)
                ->with('min_product_price_tag',$min_product_price_tag)
                ->with('max_product_price_tag',$max_product_price_tag)
                ->with('min_amount_tag',$min_amount_tag)
                ->with('max_amount_tag',$max_amount_tag)
                ->with('product_tag',$product_tag)
                ->with('list_product_tag',$list_product_tag)
                ->with('product_news',$product_news)
                ->with('product_max',$product_max)
                ->with('url_canonical',$url_canonical);
    }

    /* danh sách yêu thích */
    public function client_like_product(Request $request){
        $url_canonical = $request->url();
        //danh sách danh mục
        $category_product=CategoryProduct::where('category_product_status','1')->orderBy('category_product_id','desc')->get();
        //xuất xứ
        $origin=Origin::where('origin_status','1')->orderBy('origin_id','desc')->get();
        //mới nhất
        $product_news=Product::where('product_status','1')->orderBy('product_id','desc')->limit(3)->get();
        //bán chạy
        $product_max=Product::orderBy('product_sold', 'desc')->take(3)->get();
        return view('client.product.client_like_product')
                ->with('category_product',$category_product)
                ->with('origin',$origin)
                ->with('product_news',$product_news)
                ->with('product_max',$product_max)
                ->with('url_canonical',$url_canonical);
    }
    //thêm yêu thích
    public function client_add_like_product(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $like = Session::get('like');
        if($like==true){
            $is_avaiable = 0;
            foreach($like as $key => $value){
                if($value['product_id']==$data['like_product_id']){
                    $is_avaiable++;
                    $like[$key]['product_quantity'] ++;
                    Session::put('like',$like);
                }
            }
            if($is_avaiable == 0){
                $like[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['like_product_id'],
                    'product_name' => $data['like_product_name'],
                    'product_image' => $data['like_product_image'],
                    'product_packing' => $data['like_product_packing'],
                    'product_price' => $data['like_product_price'],
                    'product_amount' => $data['like_product_amount'],
                    'product_quantity' => $data['like_product_quantity']
                );
                Session::put('like',$like);
            }
        }else{
            $like[] = array(
                'session_id' => $session_id,
                'product_id' => $data['like_product_id'],
                'product_name' => $data['like_product_name'],
                'product_image' => $data['like_product_image'],
                'product_packing' => $data['like_product_packing'],
                'product_price' => $data['like_product_price'],
                'product_amount' => $data['like_product_amount'],
                'product_quantity' => $data['like_product_quantity']
            );
            Session::put('like',$like);
        }
        Session::save();


    }
    //xóa 1 yêu thích
    public function client_delete_like_product($session_id){
        $like = session::get('like');
        if($like==true){
            foreach($like as $key => $value){
                if($value['session_id']==$session_id){
                    unset($like[$key]);                 //key mang vị trí
                }
            }
            session::put('like',$like);
            return Redirect::back()->with('message','Xóa sản phẩm khỏi yêu thích thành công!');
        }
    }
    //xóa hết yêu thích
    public function client_delete_all_like_product(){
        $like = session::get('like');
        if($like==true){
            session::forget('like');
            return redirect()->back()->with('message','Xóa tất cả thành công!');
        }
    }


    //xem nhanh
    public function client_view_now_product(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        $show['product_id']=$product->product_id;
        $show['product_name']=$product->product_name;
        $show['product_image']='<p><img width="100%" src="'.URL('public/upload/product/'.$product->product_image).'"></p>';
        $show['product_amount']=$product->product_amount;
        $show['product_sold']=$product->product_sold;
        $show['product_packing']=$product->product_packing;
        if($product->product_sale == NULL){
            $show['product_price']=number_format($product->product_price,0,'.','.').'VND';
        }else{
            $show['product_price']=number_format($product->product_sale,0,'.','.').'VND';
        }
        $show['product_summary']=$product->product_summary;
        $show['product_detail']=$product->product_detail;
        /*
        $gallery = Gallery::where('product_id',$product_id)->get();
        $show['product_gallery']='';
        foreach($gallery as $key => $show_gallery){
            $show['product_gallery'].='<p><img width="100%" src="'.URL('public/upload/gallery/'.$show_gallery->gallery_image).'"></p>';
        } */
        $show['product_button_add']=
            '<input value="Thêm vào giỏ" type="button"
            class="add_cart_view_now w-100 input-number btn btn-primary"
            style="border: 1.5px solid rgba(0, 0, 0, 0.1); border-radius: 20px; text-align:center"
            name="add_cart_view_now" data-id_product="'.$product->product_id.'">';

        $show['product_detail']=
            '<input value="Chi tiết sản phẩm" type="button"
            class="detail_view_now w-100 input-number btn btn-primary"
            style="border: 1.5px solid rgba(0, 0, 0, 0.1); border-radius: 20px; text-align:center"
            name="detail_view_now" data-id_product="'.$product->product_id.'">';

        $show['product_value'] =
            '<input type="hidden" value="'.$product->product_id.'"
                class="cart_product_id_'.$product->product_id.'">
            <input type="hidden" value="'.$product->product_name.'"
                class="cart_product_name_'.$product->product_id.'">
            <input type="hidden" value="'.$product->product_image.'"
                class="cart_product_image_'.$product->product_id.'">
            <input type="hidden" value="'.$product->product_packing.'"
                class="cart_product_packing_'.$product->product_id.'">
            <input type="hidden" value="'.$product->product_price.'"
                class="cart_product_price_'.$product->product_id.'">
            <input type="hidden" value="'.$product->product_amount.'"
                class="cart_product_amount_'.$product->product_id.'">
            <input type="hidden" value="1"
                class="cart_product_quantity_'.$product->product_id.'">';
        echo json_encode($show);
    }

    /* TÌM KIẾM SẢN PHẨM */
    public function client_search_product(Request $request){
        $url_canonical = $request->url();
        $keyword = $request->keyword_search; //biến = name bên search
        $search = Product::where('product_name','LIKE','%'.$keyword.'%')->get();

        foreach ($search as $key => $value){
            $category_id = $value->category_product_id;
        }
        $related_product = Product::with('category_product')
                                    ->orderBy('product_id','desc')
                                    ->where('category_product_id',$category_id)
                                    ->where('product_status','1')                           //hiện những cái không ẩn
                                    /* ->whereNotIn('product.product_id',[$product_id]) */   //whereNotIn lấy giống danh mục và trừu ra cái có id = nó
                                    ->get();
        return view('client.product.client_search_product')
                ->with('search_product',$search)
                ->with('related_product',$related_product)
                ->with('url_canonical',$url_canonical);
    }


//}END_CLIENT




/* TÌM KIẾM */
    public function show($product_id){
        $product = Product::findOrFail($product_id);

        $data = 'Trái cây: ' . $product->product_name
            . '<br/>Giá: ' . $product->product_price
            . '<br/>Danh mục: ' . $product->category_product_name
            . '<br/>Xuất xứ: ' . $product->origin_name;

        return $data;
    }

    public function searchByName(Request $request){
        $product = Product::where('product_status',1)->where('product_name', 'like', '%' . $request->value . '%')->get();

        return response()->json($product);
    }

    public function searchByPrice(Request $request){
        $product = Product::select('product_price')->groupBy('product_price')->where('product_status',1)->where('product_price', 'like', '%' . $request->value . '%')->get();

        return response()->json($product);
    }
    public function searchByCategory(Request $request){
        $category = CategoryProduct::where('category_product_status',1)->where('category_product_name', 'like', '%' . $request->value . '%')->get();

        return response()->json($category);
    }
    public function searchByOrigin(Request $request){
        $category = Origin::where('origin_status',1)->where('origin_name', 'like', '%' . $request->value . '%')->get();

        return response()->json($category);
    }


}
