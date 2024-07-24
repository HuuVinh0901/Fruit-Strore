<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistical;
use App\Models\Client;
use App\Models\Admin;
use App\Models\News;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
session_start();

class StatisticalController extends Controller
{
/* KIỂM TRA ĐƯỜNG DẪN */
    public function admin_test_login_admin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('admin_home_dashboard');
        }
        else{
            return Redirect::to('/')->send();

        }
    }

/* ĐƠN HÀNG */
    public function admin_order_statistical(){
        $this->admin_test_login_admin();
        return view('admin.statistical.admin_order_statistical');
    }

    //xem thống kê
    public function admin_submit_order_statistical(Request $request){
        $this->admin_test_login_admin();
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $profit = 0;
        $statistical = Statistical::whereBetween('statistical_order_date',[$from_date,$to_date])
                                    ->orderBy('statistical_order_date','DESC')
                                    ->get();
        foreach($statistical as $key => $show_statistical){
            $chart_data[] = array(
                'order_date' => $show_statistical->statistical_order_date,//ngày                tự đặt = csdl
                'price_sell' => $show_statistical->statistical_price_sell,//doanh số
                'profit' => $show_statistical->statistical_profit,//lợi nhuận
                /* 'cost_buy' => $show_statistical->statistical_cost_buy,//giá gốc */
                /* 'product_quantity' => $show_statistical->statistical_product_quantity,//số lượng đã bán ngày hôm đó
                'order_quantity' => $show_statistical->statistical_order_quantity,//tổng đơn hàng */
            );
        }


        echo $data = json_encode($chart_data);
    }

    //lọc theo thời gian
    public function admin_filter_order_statistical(Request $request){
        $this->admin_test_login_admin();
        $data = $request->all();
        /* echo $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s'); */

        $profit = 0;
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $seven_days_ago = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();//format giống csdl
        $three_six_five_days_ago = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $start_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $start_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString(); //hiện tại trừ 1 tháng rồi bắt đầu từ 1 của tháng đó
        $end_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        if($data['value_filter']=='7_days_ago'){
            $statistical = Statistical::whereBetween('statistical_order_date',[$seven_days_ago,$today])
                                        ->orderBy('statistical_order_date','ASC')
                                        ->get();

        }elseif($data['value_filter']=='last_month'){
            $statistical = Statistical::whereBetween('statistical_order_date',[$start_last_month,$end_last_month])
                                        ->orderBy('statistical_order_date','ASC')
                                        ->get();

        }elseif($data['value_filter']=='this_month'){
            $statistical = Statistical::whereBetween('statistical_order_date',[$start_this_month,$today])
                                        ->orderBy('statistical_order_date','ASC')
                                        ->get();

        }elseif($data['value_filter']=='365_days_ago'){
            $statistical = Statistical::whereBetween('statistical_order_date',[$three_six_five_days_ago,$today])
                                        ->orderBy('statistical_order_date','ASC')
                                        ->get();
        }

        foreach($statistical as $key => $show_statistical){
            $chart_data[] = array(
                'order_date' => $show_statistical->statistical_order_date,//ngày                tự đặt = csdl
                'price_sell' => $show_statistical->statistical_price_sell,//doanh số
                'profit' => $show_statistical->statistical_profit,//lợi nhuận
                /* 'cost_buy' => $show_statistical->statistical_cost_buy,//giá gốc
                'product_quantity' => $show_statistical->statistical_product_quantity,//số lượng đã bán ngày hôm đó
                'order_quantity' => $show_statistical->statistical_order_quantity,//tổng đơn hàng */
            );
        }
        echo $data = json_encode($chart_data);
    }

    //hiển thị 30 ngày qua
    public function admin_show_30days_order_statistical(){
        $this->admin_test_login_admin();
        $threety_days_ago = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $profit = 0;
        $statistical = Statistical::whereBetween('statistical_order_date',[$threety_days_ago,$today])->get();
        foreach($statistical as $key => $show_statistical){
            $chart_data[] = array(
                'order_date' => $show_statistical->statistical_order_date,//ngày                tự đặt = csdl
                'price_sell' => $show_statistical->statistical_price_sell,//doanh số
                'profit' => $show_statistical->statistical_profit,//lợi nhuận
                /* 'cost_buy' => $show_statistical->statistical_cost_buy,//giá gốc
                'product_quantity' => $show_statistical->statistical_product_quantity,//số lượng đã bán ngày hôm đó
                'order_quantity' => $show_statistical->statistical_order_quantity,//tổng đơn hàng */
            );
        }
        echo $data = json_encode($chart_data);
    }



/* DOANH THU */
    /* thống kê */
    public function admin_revenue_statistical(){
        $this->admin_test_login_admin();
        $product_amount = 0;
        $client = Client::count('client_id');
        $product = Product::count('product_id');
        $news = News::count('news_id');
        $product_amount = Product::sum('product_amount');
        return view('admin.statistical.admin_revenue_statistical')
                ->with('client',$client)
                ->with('product',$product)
                ->with('news',$news)
                ->with('product_amount',$product_amount);
    }

    /* doanh thu lọc */
    public function admin_submit_revenue_statistical(Request $request){
        $this->admin_test_login_admin();
        $data = $request->all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $seven_days_ago = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();//format giống csdl
        $three_six_five_days_ago = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $start_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $start_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString(); //hiện tại trừ 1 tháng rồi bắt đầu từ 1 của tháng đó
        $end_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        if($data['value_filter']=='7_days_ago'){
            $price_sell = Statistical::whereBetween('statistical_order_date',[$seven_days_ago,$today])->sum('statistical_price_sell');
            $profit = Statistical::whereBetween('statistical_order_date',[$seven_days_ago,$today])->sum('statistical_profit');
            $product_quantity = Statistical::whereBetween('statistical_order_date',[$seven_days_ago,$today])->sum('statistical_product_quantity');
            $order_quantity = Statistical::whereBetween('statistical_order_date',[$seven_days_ago,$today])->sum('statistical_order_quantity');
        }elseif($data['value_filter']=='last_month'){
            $price_sell = Statistical::whereBetween('statistical_order_date',[$start_last_month,$end_last_month])->sum('statistical_price_sell');
            $profit = Statistical::whereBetween('statistical_order_date',[$start_last_month,$end_last_month])->sum('statistical_profit');
            $product_quantity = Statistical::whereBetween('statistical_order_date',[$start_last_month,$end_last_month])->sum('statistical_product_quantity');
            $order_quantity = Statistical::whereBetween('statistical_order_date',[$start_last_month,$end_last_month])->sum('statistical_order_quantity');
        }elseif($data['value_filter']=='this_month'){
            $price_sell = Statistical::whereBetween('statistical_order_date',[$start_this_month,$today])->sum('statistical_price_sell');
            $profit = Statistical::whereBetween('statistical_order_date',[$start_this_month,$today])->sum('statistical_profit');
            $product_quantity = Statistical::whereBetween('statistical_order_date',[$start_this_month,$today])->sum('statistical_product_quantity');
            $order_quantity = Statistical::whereBetween('statistical_order_date',[$start_this_month,$today])->sum('statistical_order_quantity');
        }elseif($data['value_filter']=='365_days_ago'){
            $price_sell = Statistical::whereBetween('statistical_order_date',[$three_six_five_days_ago,$today])->sum('statistical_price_sell');
            $profit = Statistical::whereBetween('statistical_order_date',[$three_six_five_days_ago,$today])->sum('statistical_profit');
            $product_quantity = Statistical::whereBetween('statistical_order_date',[$three_six_five_days_ago,$today])->sum('statistical_product_quantity');
            $order_quantity = Statistical::whereBetween('statistical_order_date',[$three_six_five_days_ago,$today])->sum('statistical_order_quantity');
        }elseif($data['value_filter']=='all'){
            $price_sell = Statistical::sum('statistical_price_sell');
            $profit = Statistical::sum('statistical_profit');
            $product_quantity = Statistical::sum('statistical_product_quantity');
            $order_quantity = Statistical::sum('statistical_order_quantity');
        }

        Session::put('price_sell',$price_sell);
        Session::put('profit',$profit);
        Session::put('product_quantity',$product_quantity);
        Session::put('order_quantity',$order_quantity);
        return view('admin.statistical.admin_revenue_statistical');
    }

    /* doanh thu chọn theo ngày đến ngày */
    public function admin_submit_date_revenue_statistical(Request $request){
        $this->admin_test_login_admin();
        $data = $request->all();

        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $price_sell = Statistical::whereBetween('statistical_order_date',[$from_date,$to_date])->sum('statistical_price_sell');
        $profit = Statistical::whereBetween('statistical_order_date',[$from_date,$to_date])->sum('statistical_profit');
        $product_quantity = Statistical::whereBetween('statistical_order_date',[$from_date,$to_date])->sum('statistical_product_quantity');
        $order_quantity = Statistical::whereBetween('statistical_order_date',[$from_date,$to_date])->sum('statistical_order_quantity');

        Session::put('price_sell',$price_sell);
        Session::put('profit',$profit);
        Session::put('product_quantity',$product_quantity);
        Session::put('order_quantity',$order_quantity);

        return view('admin.statistical.admin_revenue_statistical');
    }

}

