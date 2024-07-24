<?php

namespace App\Http\Controllers;

use App\Models\AdminRole;
use App\Models\Payment;
use App\Models\Client;
use App\Models\InfoOrder;
use App\Models\Order;
use App\Models\DetailOrder;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Status;
use App\Models\Statistical;
use App\Models\Cost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

session_start();

class OrderController extends Controller
{
    //kiểm tra đăng nhập
    public function admin_test_login_admin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('admin_revenue_statistical');
        }
        else{
            return Redirect::to('/')->send();

        }
    }

    //danh sách đơn hàng
    public function admin_list_order(){
        $this->admin_test_login_admin();
        $order = Order::with('client')->with('payment')->with('status')->with('admin')->orderBy('order_id', 'DESC')->get();
        return view('admin.order.admin_list_order')
                    ->with('order',$order);
    }

    //chi tiết đơn hàng
    public function admin_detail_order($order_code){
        if(Auth::id()==NULL){
            return Redirect('admin_login_staff')->with('message','Bạn phải đăng nhập để xem chi tiết đơn hàng');
        }
        $detail_order = DetailOrder::where('order_code',$order_code)->get();
        Session::put('order_code',$order_code);
        $list_status = Status::orderBy('status_id','ASC')->get();
        $order = Order::with('admin')->where('order_code',$order_code)->get();
        foreach($order as $key => $show_order){
            $client_id = $show_order->client_id;
            $info_order_id = $show_order->info_order_id;
            $payment_id = $show_order->payment_id;
            $discount_order = $show_order->discount_code;
            $status_id = $show_order->status_id;
        }//ra ngoài vì lấy 1 cái
        $client = Client::where('client_id',$client_id)->first(); //lấy 1 khách hàng dựa trên 1 id

        $info_order = InfoOrder::with('province')->with('district')->with('ward')->where('info_order_id',$info_order_id)->first();

        $payment = Payment::where('payment_id',$payment_id)->first(); //lấy vận chuyển 1 nơi

        $discount = Discount::where('discount_code',$discount_order)->first();

        $status = Status::where('status_id',$status_id)->first(); //lấy vận chuyển 1 nơi

        /* $detail_order_product = DetailOrder::with('product')->where('order_code',$order_code)->get(); */

        return view('admin.order.admin_detail_order')
                ->with('detail_order',$detail_order)
                ->with('list_status',$list_status)
                ->with('order',$order)
                ->with('client',$client)
                ->with('info_order',$info_order)
                ->with('payment',$payment)
                ->with('discount',$discount)
                ->with('status',$status);
    }

    //xóa đơn hàng
    public function admin_delete_order($order_code){
        $this->admin_test_login_admin();
        Order::where('order_code',$order_code)->delete();
        Session::put('message',"Xóa đơn hàng thành công.");
        return Redirect::to('/admin_list_order');
    }

    //cập nhật ở danh sách đơn hàng
    public function admin_update_status_order($order_code){
        $this->admin_test_login_admin();
        $status = Status::orderBy('status_id','ASC')->get();
        $update_order = Order::where('order_code',$order_code)->get();

        return view('admin.order.admin_update_status_order')
                ->with('update_order',$update_order)
                ->with('status',$status);

    }
    /* public function admin_submit_update_status_order(Request $request, $order_code){
        $database = $request->all();
        $order = Order::where('order_code',$order_code)->first();
        $order->status_id = $database['status'];
        $order->save();
        session::put('message',"Cập nhật đơn hàng thành công.");
        return Redirect::to('/admin_list_order');
    } */


    // cập nhật trong chi tiết đơn hàng
    public function admin_update_status_detail_order(Request $request){
        $this->admin_test_login_admin();
        $data = $request->all();
        $order = Order::with('client')->with('payment')->with('status')->with('info_order')->find($data['order_id']);
        $order->status_id = $data['order_status'];
        $order->save();

        /* phần mail */
        $order_code = $order->order_code;
        $order_date = $order->order_date;

        $status_id = $order->status_id;

        $payment_method = $order->payment->payment_method;

        $fee = $order->delivery_fee;

        $info_order_id = $order->info_order_id;
        $info_order_name = $order->info_order->info_order_name;
        $info_order_email = $order->info_order->info_order_email;
        $info_order_phone = $order->info_order->info_order_phone;
        $info_order_address = $order->info_order->info_order_address;
        $info_order_note = $order->info_order->info_order_note;

        $info_order = InfoOrder::with('province')->with('district')->with('ward')->find($info_order_id);

        $province_name = $info_order->province->province_name;
        $district_name = $info_order->district->district_name;
        $ward_name = $info_order->ward->ward_name;

        /* Tính doanh thu */
        $statistical = Statistical::where('statistical_order_date',$order_date)->get(); //date trong thống kê = ngày đặt
        if($statistical){
            $statistical_count = $statistical->count();
        }else{
            $statistical_count = 0;
        }

        if($order->status_id == 2){
            foreach($data['product_id'] as $key1 => $show_product_id){                       //sả phẩm trong đơn hàng as key
                $product = Product::find($show_product_id);                         //tìm số lượng dựa theo id
                $product_amount = $product->product_amount;
                $product_sold = $product->product_sold;

                foreach($data['product_quantity'] as $key2 => $show_product_quantity){
                    if($key1 == $key2){
                        $product_remain = $product_amount - $show_product_quantity;
                        $product->product_amount = $product_remain;
                        $product->product_sold = $product_sold + $show_product_quantity;
                        $product->save();
                    }
                }
            }

        }
        if($order->status_id == 6 || $order->status_id == 5){
            foreach($data['product_id'] as $key1 => $show_product_id){                       //sả phẩm trong đơn hàng as key
                $product = Product::find($show_product_id);                         //tìm số lượng dựa theo id
                $product_amount = $product->product_amount;
                $product_sold = $product->product_sold;

                foreach($data['product_quantity'] as $key2 => $show_product_quantity){
                    if($key1 == $key2){
                        $product_remain = $product_amount + $show_product_quantity;
                        $product->product_amount = $product_remain;
                        $product->product_sold = $product_sold - $show_product_quantity;
                        $product->save();
                    }
                }
            }
        }

        if($order->status_id == 4){

            $price_sell = 0;        //doanh thu
            $cost_buy = 0;          //giá gốc
            $profit = 0;            //lợi nhuận
            $product_quantity = 0;  //số lượng bán hôm đó
            $order_quantity = 0;    //số lượng đơn trong ngày

            foreach($data['product_id'] as $key1 => $show_product_id){                       //sả phẩm trong đơn hàng as key
                $product = Product::find($show_product_id);                         //tìm số lượng dựa theo id
                /* $product_amount = $product->product_amount;
                $product_sold = $product->product_sold; */
                $product_cost = $product->product_cost;
                $product_price = $product->product_price;
                $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

                /* $cost = Cost::with('product')->where('product_id',$show_product_id)->get();
                foreach($cost as $key => $show_cost){
                    $product_cost = $show_cost->cost_buy; */

                    foreach($data['product_quantity'] as $key2 => $show_product_quantity){
                        if($key1 == $key2){
                            /* $product_remain = $product_amount - $show_product_quantity;
                            $product->product_amount = $product_remain;
                            $product->product_sold = $product_sold + $show_product_quantity;
                            $product->save(); */
                            /* update doanh thu */
                            $product_quantity += $show_product_quantity;
                            $order_quantity +=1;
                            $price_sell += $product_price*$show_product_quantity;
                            $cost_buy += $product_cost*$show_product_quantity;
                            $profit = $price_sell - $cost_buy;
                       }
                    }
                /* } */
            }
            /* update doanh thu database*/
            if($statistical_count>0){ /* nếu ngày trùng với ngày */
                $update = Statistical::where('statistical_order_date',$order_date)->orderBy('statistical_order_date','ASC')->first();//date trong thống kê = ngày đặt
                $update->statistical_price_sell = $update->statistical_price_sell + $price_sell;
                $update->statistical_cost_buy = $update->statistical_cost_buy + $cost_buy;
                $update->statistical_profit = $update->statistical_profit + $profit;
                $update->statistical_product_quantity = $update->statistical_product_quantity + $product_quantity;
                $update->statistical_order_quantity = $update->statistical_order_quantity + 1;
                $update->save();
            }else{
                $new = new Statistical();
                $new->statistical_order_date = $order_date;
                $new->statistical_price_sell = $price_sell;
                $new->statistical_cost_buy = $cost_buy;
                $new->statistical_profit = $profit;
                $new->statistical_product_quantity = $product_quantity;
                $new->statistical_order_quantity = 1;
                $new->save();
            }
        }

        /* gửi mail */
        $todayy = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');

        $title_mail = "Trạng thái đơn hàng từ trái cây nhập khẩu ImportedFruit".' '.$todayy;
        $client = Client::where('client_id',$order->client_id)->first();
        $data['email'][] = $client->client_email;

        /* lấy giỏ hàng */
        foreach($data['product_id'] as $key1 => $show_product_id){
            $product_mail = Product::find($show_product_id);
            foreach($data['product_quantity'] as $key2 => $show_product_quantity){
                if($key1==$key2){
                    $cart_array[] = array(
                        'product_name' => $product_mail['product_name'],
                        'product_packing' => $product_mail['product_packing'],
                        'product_price' => $product_mail['product_price'],
                        'product_quantity' => $show_product_quantity
                    );
                }
            }
        }

        /* lấy thông tin người nhận hàng */
        $info_order_array = array(
            'info_order_name' => $info_order_name,
            'info_order_email' => $info_order_email,
            'info_order_phone' => $info_order_phone,
            'province_name' => $province_name,
            'district_name' => $district_name,
            'ward_name' => $ward_name,
            'info_order_address' => $info_order_address,
            'info_order_note' => $info_order_note
        );

        /* lấy đơn hàng */
        if($order->discount_code!='Null'){
            $discount = Discount::where('discount_code',$order->discount_code)->first();
            $discount->discount_amount = $discount->discount_amount - 1;
            $discount->discount_client = $discount->discount_client.','.Session::get('client_id');
            $discount_category = $discount->discount_category;
            $discount_be = $discount->discount_be;
            $discount_mail = $discount->discount_code;

            $discount->save();
        }else{
            $discount_be = '';
            $discount_category = '';
            $discount_mail = '';
        }
        $order_array = array(
            'created_at' => $todayy,
            'order_code' => $order_code,
            'client_name' => $order->client->client_name,
            'discount_category' => $discount_category,
            'discount_code' => $discount_mail,
            'discount_be' => $discount_be,
            'delivery_fee' => $fee,
            'payment_method' => $payment_method,
            'status_id' => $status_id
        );

        Mail::send('admin.mail.admin_status_mail',[  'cart_array'=>$cart_array,
                                                    'info_order_array'=>$info_order_array,
                                                    'order_array'=>$order_array],
                                                    function($message) use ($data,$title_mail){
                                                        $message->to($data['email'])->subject($title_mail);
                                                        $message->from($data['email'],$title_mail);
                                                    });

    }



    //shipper
    public function admin_shipper_order($order_code){
        $shipper = AdminRole::with('admin')->where('role_role_id',4)->get();
        $order_code = Order::where('order_code',$order_code)->get();
        foreach($order_code as $key => $show_order){
            $info_order_id = $show_order->info_order_id;
        }//ra ngoài vì lấy 1 cái

        $district_order = InfoOrder::with('district')->where('info_order_id',$info_order_id)->first();
        return view('admin.order.admin_shipper_order')
                    ->with('order_code',$order_code)
                    ->with('shipper',$shipper)
                    ->with('district_order',$district_order);
    }

    public function admin_submit_shipper_order(Request $request, $order_code){
        $data = $request->all();
        $order = Order::where('order_code',$order_code)->first();
        $order->admin_id = $data['shipper_order'];
        $order->save();

        session::put('message',"Cập nhật người giao hàng thành công.");
        return Redirect::to('/admin_list_order');
    }

    //shipper detail_order
    public function admin_shipper_detail_order($order_code){
        $shipper = AdminRole::with('admin')->where('role_role_id',4)->get();
        $order_code = Order::where('order_code',$order_code)->get();
        foreach($order_code as $key => $show_order){
            $info_order_id = $show_order->info_order_id;
        }//ra ngoài vì lấy 1 cái

        $district_order = InfoOrder::with('district')->where('info_order_id',$info_order_id)->first();
        return view('admin.order.admin_shipper_detail_order')
                    ->with('order_code',$order_code)
                    ->with('shipper',$shipper)
                    ->with('district_order',$district_order);
    }

    public function admin_submit_shipper_detail_order(Request $request, $order_code){
        $data = $request->all();
        $order = Order::where('order_code',$order_code)->first();
        $order->admin_id = $data['shipper_order'];
        $order->save();

        session::put('message',"Cập nhật người giao hàng thành công.");
        return Redirect::to('admin_detail_order/'.$order_code);
    }


    //in đơn hàng
    public function admin_print_order($order_code){
        $this->admin_test_login_admin();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->admin_show_print_order($order_code));
        return $pdf->stream();
    }

    public function admin_show_print_order($order_code){
        $this->admin_test_login_admin();
        $order = Order::with('admin')->where('order_code',$order_code)->get();
        foreach($order as $key => $show_order){
            $info_order_id = $show_order->info_order_id;
            $payment_id = $show_order->payment_id;

            $discount_order = $show_order->discount_code;
        }//ra ngoài vì lấy 1 cái
        $info_order = InfoOrder::with('province')->with('district')->with('ward')->where('info_order_id',$info_order_id)->first();

        $payment = Payment::where('payment_id',$payment_id)->first(); //lấy vận chuyển 1 nơi

        $discount = Discount::where('discount_code',$discount_order)->first();

        $detail_order_product = DetailOrder::with('product')->where('order_code',$order_code)->get(); //with product bên model detail_order

        $show ='';// Dejavu Sans
        $show.='
        <style>
            body{
                font-family: Dejavu Sans ;
                font-size: 12px;
            }
            .border{
                border: 1px solid black;
            }
            .table{
                width: 100%;
                border-collapse: collapse;
                margin-top:20px
            }
            .center{
                text-align: center;
            }
            .right{
                text-align: right;
            }
            .uppercase{
                text-transform: uppercase;
            }
        </style>
        <p class="uppercase">Cửa hàng nhập khẩu trái cây tươi ImportedFruit</p>
        <p>Nhận ship tại khu vực Cần Thơ</p>
        <p>-------------------------------------------------------------------------------</p>
        <h2 class="center uppercase"><b>ĐƠN ĐẶT HÀNG</b></h2>
        <table>
            <tbody>';
                $show.='
                    <tr>
                        <td colspan="2"><h4>Thông tin người nhận hàng</h4></td>
                    </tr>
                    <tr>
                        <td>Ngày đặt:</td>
                        <td>'.date_format($show_order->created_at,'H:i:s d/m/Y').'</td>
                    </tr>
                    <tr>
                        <td>Người nhận:</td>
                        <td>'.$info_order->info_order_name.'</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>'.$info_order->info_order_email.'</td>
                    </tr>
                    <tr>
                        <td>Điện thoại:</td>
                        <td>'.$info_order->info_order_phone.'</td>
                    </tr>
                    <tr>
                        <td>Địa chỉ:</td>
                        <td>'.$info_order->info_order_address.', '.$info_order->ward->ward_name.', '.$info_order->district->district_name.', '.$info_order->province->province_name.'</td>
                    </tr>
                    <tr>
                        <td>Ghi chú:</td>
                        <td>'.$info_order->info_order_note.'</td>
                    </tr>
                    <tr>
                        <td colspan="2"><h4>Thông tin nhân viên giao hàng</h4></td>
                    </tr>
                    <tr>
                        <td>Ngày giao:</td>
                        <td>'.date_format($show_order->created_at->addDays(1),'d/m/Y').'</td>
                    </tr>
                    <tr>
                        <td>Người giao:</td>
                        <td>'.$show_order->admin->admin_name.'</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td>'.$show_order->admin->admin_phone.'</td>
                    </tr>';
                $show.='
            </tbody>
        </table>
        <table class="table">
            <thead>
                <th class="border">Trái cây</th>
                <th class="border">Quy cách</th>
                <th class="border">Giá tiền</th>
                <th class="border">Số lượng</th>
                <th class="border right">Thành tiền</th>
            </thead>
            <tbody>';
                $total = 0;
                $subtotal = 0;
                foreach($detail_order_product as $key => $product){
                    $total = $product->product_price * $product->product_quantity;
                    $subtotal += $total;
                    $show.='
                    <tr>
                        <td class="border">'.$product->product_name.'</td>
                        <td class="border">'.$product->product_packing.'</td>
                        <td class="border center">'.number_format($product->product_price,0,'.','.').'</td>
                        <td class="border center">'.$product->product_quantity.'</td>
                        <td class="border right">'.number_format($product->product_quantity*$product->product_price,0,'.','.').' VND</td>
                    </tr>';
                }
                    $show.='
                    <tr>
                        <td colspan="4" class="border right">
                            Tiền hàng
                        </td>
                        <td class="border right">'.number_format($subtotal,0,'.','.').' VND</td>
                    </tr>

                    ';

                    if($show_order->discount_code != 'Null'){
                        if($discount->discount_category == 1){
                            $show.='
                                <tr>
                                    <td colspan="4" class="border right">
                                        Mã giảm giá '.$discount->discount_be.'%
                                    </td>
                                    <td class="border right">- '
                                        .number_format((($subtotal*$discount->discount_be)/100),0,'.','.').
                                    ' VND</td>
                                </tr>';
                        }elseif($discount->discount_category == 2){
                            $show.='
                            <tr>
                                <td colspan="4" class="border right">
                                    Mã giảm giá
                                </td>
                                <td class="border right">
                                    - '.number_format($discount->discount_be,0,'.','.').
                                ' VND</td>
                            </tr>';
                        }
                    }
                    $show.='
                    <tr>
                        <td colspan="4" class="border right">
                            Phí vận chuyển
                        </td>
                        <td class="border right">'.number_format($show_order->delivery_fee,0,'.','.').' VND</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="border right">
                            <b>TỔNG TIỀN</b>
                        </td>';
                        //Tổng tiền

                        if($show_order->discount_code!='Null'){
                            if($discount->discount_category == 1){
                                $total_discount = ($subtotal * $discount['discount_be']) / 100;
                                $total_money = $subtotal - $total_discount + $show_order->delivery_fee;
                            }elseif($discount->discount_category == 2){
                                $total_money = ($subtotal+$show_order->delivery_fee) - $discount['discount_be'];
                            }
                            $show.='
                            <td class="border right">'.number_format($total_money, 0, ',', '.').' VND</td>
                        </tr>';
                        }else{
                            $total_money = $subtotal+$show_order->delivery_fee;
                            $show.='
                            <td class="border right">'.number_format($total_money, 0, ',', '.').' VND</td>
                        </tr>';
                        }
                    $show.='
            </tbody>
        </table>
        <h4>Phương thức thanh toán: '.$payment->payment_method.'</h4>
        <p class="right"><i>'.$info_order->district->district_name.', ngày&nbsp;&nbsp;&nbsp;&nbsp;tháng&nbsp;&nbsp;&nbsp;&nbsp;năm 2023</i></p>
        <table class="table">
            <tr>
                <td>Người lập phiếu</td>
                <td class="center">Nhân viên giao hàng</td>
                <td class="right">Người nhận</td>
            </tr>
        </table>';

        return $show;
    }




    //cập nhật đơn hàng client
   /*  public function admin_update_status_order_client($order_code){
        $this->admin_test_login_admin();
        $status = Status::orderBy('status_id','ASC')->get();
        $update_order = Orders::where('order_code',$order_code)->get();
        return view('admin.client.admin_update_status_order_client')
                ->with('update_order',$update_order)
                ->with('status',$status);

    }

    public function admin_submit_update_status_order_client(Request $request, $order_code){
        $database = $request->all();
        $order = Orders::where('order_code',$order_code)->first();
        $order->status_id = $database['status'];
        $order->save();
        session::put('message',"Cập nhật đơn hàng thành công.");
        return Redirect::to('/admin_list_order_client');
    } */




/* CLIENT */
    public function client_thank_order(Request $request){
        $url_canonical = $request->url();
        return view('client.order.client_thank_order')->with('url_canonical',$url_canonical);
    }

    public function client_detail_order(Request $request, $order_code){
        $url_canonical = $request->url();
        //chi tiết đơn hàng
        if(Session::get('client_id')==NULL){
            return Redirect('client_login_client')->with('message','Bạn phải đăng nhập để xem chi tiết đơn hàng');
        }
        $detail_order = DetailOrder::where('order_code',$order_code)->get();
        $order = Order::with('client')->with('info_order')->with('payment')->with('status')->with('admin')
                            ->where('order_code',$order_code)
                            ->where('client_id',Session::get('client_id'))
                            ->orderBy('created_at','DESC')
                            ->get();
        foreach($order as $key => $show_order){
            $client_id = $show_order->client->client_id;
            $info_order_id = $show_order->info_order->info_order_id;
            $payment_id = $show_order->payment->payment_id;

            $discount_order = $show_order->discount_code;

            $status_id = $show_order->status_id;
        }
        //thông tin nhạn hàng
        $info_order = InfoOrder::with('province')->with('district')->with('ward')->where('info_order_id',$info_order_id)->first(); //lấy vận chuyển 1 nơi
        $payment = Payment::where('payment_id',$payment_id)->first(); //lấy vận chuyển 1 nơi
        $discount = Discount::where('discount_code',$discount_order)->first();
        $status = Status::where('status_id',$status_id)->first();

        $detail_order_product = DetailOrder::with('product')->where('order_code',$order_code)->get();
        //danh sách đặt hàng
        $list_order = Order::with('client')->with('info_order')->with('payment')->with('status')
                                ->where('client_id',$client_id)
                                ->whereNotIn('order_code',[$order_code])
                                ->orderBy('created_at','DESC')->paginate(5);
        foreach($order as $key => $show_order){
            $client_id = $show_order->client_id;
        }
        $discount = Discount::where('discount_code',$discount_order)->first();

        return view('client.order.client_detail_order')
                    ->with('detail_order',$detail_order)
                    ->with('order',$order)
                    ->with('status',$status)
                    ->with('info_order',$info_order)
                    ->with('payment',$payment)
                    ->with('discount',$discount)
                    ->with('url_canonical',$url_canonical)
                    ->with('detail_order_product',$detail_order_product)
                    ->with('list_order',$list_order);
    }

    //lịch sử mua hàng
    public function client_history_order(Request $request){
        $url_canonical = $request->url();
        if(Session::get('client_id')==NULL){
            return Redirect('client_login_client')->with('message','Bạn phải đăng nhập để xem lịch sử đơn hàng');
        }
        $history_order = Order::with('client')->with('payment')->with('status')->with('info_order')
                                ->where('client_id',Session::get('client_id'))
                                ->orderBy('created_at','DESC')->paginate(7);
        return view('client.order.client_history_order')
            ->with('history_order',$history_order)
            ->with('url_canonical',$url_canonical);
    }


    //hủy đơn hàng
    public function client_cancel_order(Request $request){
        $data = $request->all();
        $order = Order::with('client')->with('payment')->with('status')->with('info_order')->find($data['order_id']);

        if($order->status_id == 2){
            $order->status_id = 6;

            if($order->status_id == 6){
                foreach($data['product_id'] as $key1 => $show_product_id){                       //sả phẩm trong đơn hàng as key
                    $product = Product::find($show_product_id);                         //tìm số lượng dựa theo id
                    $product_amount = $product->product_amount;
                    $product_sold = $product->product_sold;

                    foreach($data['product_quantity'] as $key2 => $show_product_quantity){
                        if($key1 == $key2){
                            $product_remain = $product_amount + $show_product_quantity;
                            $product->product_amount = $product_remain;
                            $product->product_sold = $product_sold - $show_product_quantity;
                            $product->save();
                        }
                    }
                }
            }
        }
        elseif($order->status_id == 1){
            $order->status_id = 6;
        }

        $order->save();


        /* phần mail */
        $order_code = $order->order_code;

        /* gửi mail */
        $todayy = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');


        $client_email = $order->client->client_email;

        $data['email'] = 'thub1910152@student.ctu.edu.vn';
        $title_mail = "Đơn hàng bị hủy bởi".' '.$client_email.'lúc '.$todayy;

        $order_array = array(
            'created_at' => $todayy,
            'order_code' => $order_code,
            'client_name' => $order->client->client_name,
        );

        Mail::send('client.order.client_cancel_order',[
                                                    'order_array'=>$order_array],
                                                    function($message) use ($data,$title_mail){
                                                        $message->to($data['email'])->subject($title_mail);
                                                        $message->from($data['email'],$title_mail);
                                                    });

    }

}


