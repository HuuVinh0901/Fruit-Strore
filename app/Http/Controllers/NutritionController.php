<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Nutrition;
use Faker\Core\Number;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();

class NutritionController extends Controller
{
    /*
    thue
    public function index(Request $request){

        if($request->ajax()){
            $nutrition = Nutrition::all();
            dd($nutrition);
            return response()->json($nutrition);
        }

    } */
    public function client_list_nutrition($tag, Request $request){
        $url_canonical = $request->url();
        /* $query = '%'.$tag.'%';
        $products = Product::where('product_tag','like',$query)->paginate(4);
        $nutrition = Nutrition::where('nutrition_tag','like',$query)->first();
        $nutritions =Nutrition::all('nutrition_tag');

        $tag = [];
        foreach($nutritions as $i){
            array_push($tag,$i->nutrition_tag);
        }

        $nutritions_json = json_encode($tag); */
        $query = '%'.$tag.'%';
        $nutrition = Nutrition::where('nutrition_tag','like',$query)->first();
        $products = Product::where('product_tag','like',$query)->paginate(4);
        return view('client.nutrition.client_list_nutrition',compact('url_canonical','nutrition','products'));

    }

    public function client_home_nutrition(Request $request){
        $url_canonical = $request->url();
        //bán chạy
        $product_max = Product::orderBy('product_sold', 'desc')->take(4)->get();
        return view('client.nutrition.client_home_nutrition',compact('url_canonical','product_max'));
    }

//tự làm tìm kiếm
    public function client_show_nutrition($nutrition_id){
        $nutrition = Nutrition::findOrFail($nutrition_id);

        $data = $nutrition->nutrition_tag;

        return $data;
    }

    public function client_search_nutrition(Request $request){
        $nutrition = Nutrition::where('nutrition_tag', 'like', '%' .$request->value . '%')->get();

        return response()->json($nutrition);
    }



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
    public function admin_list_nutrition(){
        $this->admin_test_login_admin();
        $list_nutrition = Nutrition::all();
        return view('admin.nutrition.admin_list_nutrition')->with('list_nutrition',$list_nutrition);
    }


    /* THÊM */
    public function admin_add_nutrition(){
        $this->admin_test_login_admin();
        return view('admin.nutrition.admin_add_nutrition');
    }
    public function admin_submit_add_nutrition(Request $request){ /* request lấy yêu cầu dữ liệu */
        $this->admin_test_login_admin();
        $database = $request->all();
        $nutrition = new Nutrition(); // new class bên model thêm mới
        $nutrition->nutrition_title = $database['title_nutrition'];
        $nutrition->nutrition_detail = $database['detail_nutrition'];
        $nutrition->nutrition_tag = $database['tag_nutrition'];
        $nutrition->save();
        session::put('message',"Thêm dinh dưỡng thành công.");
        return Redirect::to('/admin_add_nutrition'); /* thêm xong trả về */
    }

    /* CHI TIẾT */
    public function admin_detail_nutrition($nutrition_id){
        $this->admin_test_login_admin();
        $detail_nutrition = Nutrition::where('nutrition_id',$nutrition_id)->get();
        foreach ($detail_nutrition as $key => $value){
            $nutrition_id = $value->nutrition_id;
        }
        return view('admin.nutrition.admin_detail_nutrition')
                    ->with('detail_nutrition',$detail_nutrition);
    }


    /* SỬA */
    public function admin_edit_nutrition($nutrition_id){
        $this->admin_test_login_admin();
        $edit_nutrition = Nutrition::where('nutrition_id',$nutrition_id)->get();
        return view('admin.nutrition.admin_edit_nutrition')->with('edit_nutrition',$edit_nutrition);
    }
    public function admin_update_edit_nutrition(Request $request, $nutrition_id){
        $this->admin_test_login_admin();
        $database = $request->all();
        $nutrition = Nutrition::find($nutrition_id); // tìm sản phẩm dựa trên id
        $nutrition->nutrition_title = $database['title_nutrition'];
        $nutrition->nutrition_detail = $database['detail_nutrition'];
        $nutrition->nutrition_tag = $database['tag_nutrition'];
        $nutrition->save();
        session::put('message',"Chỉnh sửa dinh dưỡng thành công.");
        return Redirect::to('/admin_list_nutrition');
    }


    /* XÓA */
    public function admin_delete_nutrition($nutrition_id){
        $this->admin_test_login_admin();
        Nutrition::find($nutrition_id)->delete();
        session::put('message',"Xóa dinh dưỡng thành công.");
        return Redirect::to('/admin_list_nutrition');
    }
//}END_ADMIN
}
