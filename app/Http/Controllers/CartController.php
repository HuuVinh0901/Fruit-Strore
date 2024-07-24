<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Province;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

session_start();


class CartController extends Controller
{
//AJAX
    /*  public function client_add_ajax_cart(Request $request){
        $data = $request->all();
        print_r($data);
    } */
    public function client_add_ajax_cart(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $value){
                if($value['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                    $cart[$key]['product_quantity'] ++;
                    Session::put('cart',$cart);
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_image' => $data['cart_product_image'],
                    'product_packing' => $data['cart_product_packing'],
                    'product_price' => $data['cart_product_price'],
                    'product_amount' => $data['cart_product_amount'],
                    'product_quantity' => $data['cart_product_quantity']
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_image' => $data['cart_product_image'],
                'product_packing' => $data['cart_product_packing'],
                'product_price' => $data['cart_product_price'],
                'product_amount' => $data['cart_product_amount'],
                'product_quantity' => $data['cart_product_quantity']
            );
            Session::put('cart',$cart);
        }
        Session::save();
    }

    public function client_list_ajax_cart(Request $request){
        $url_canonical = $request->url();
        $category_product = CategoryProduct::where('category_product_status','1')->orderBy('category_product_id','desc')->get();
        $province = Province::orderBy('province_id','ASC')->get();
        return view('client.cart.client_list_ajax_cart')
                ->with('category_product',$category_product)
                ->with('province',$province)
                ->with('url_canonical',$url_canonical);
    }

    public function client_delete_ajax_cart($session_id){
        $cart = session::get('cart');
        if($cart==true){
            foreach($cart as $key => $value){
                if($value['session_id']==$session_id){
                    unset($cart[$key]);                 //key mang vị trí
                }
            }
            session::put('cart',$cart);
            return Redirect::back()->with('message','Xóa sản phẩm thành công!');
        }
    }

    public function client_update_ajax_cart(Request $request){
        $data = $request->all();
        $cart = session::get('cart');
        if($cart==true){
            $message = '';
            foreach($data['cart_quantity'] as $sessionid => $quantity){
                // echo $key; là session_id
                // echo $quantity; là số đã nhập để update
                foreach($cart as $session => $value){
                    if($value['session_id']==$sessionid && $quantity<$cart[$session]['product_amount']){
                        $cart[$session]['product_quantity'] = $quantity; //cart mang session_id update prodcut_quantity = $quantity
                        $message.='Cập nhật số lượng: '.$cart[$session]['product_name'].' thành công<br>';
                    }elseif($value['session_id']==$sessionid && $quantity>$cart[$session]['product_amount']){
                        $message.='Cập nhật số lượng '.$cart[$session]['product_name'].' thất bại vì số lượng không có đủ tại cửa hàng<br>';
                    }
                }
            }
            Session::put('cart',$cart);
            return Redirect::back()->with('message',$message);
        }else{
            return Redirect::back()->with('message','Cập nhật số lượng thành công');
        }
    }

    public function client_delete_all_ajax_cart(){
        $cart = session::get('cart');
        if($cart==true){
            session::forget('cart');
            session::forget('discount');
            return redirect()->back()->with('message','Xóa tất cả thành công!');
        }
    }



    //đếm số lượng trong giỏ hàng
    public function client_count_cart(){
        $count = count(Session::get('cart'));
        $show = '';
        if($count>0){
            $show.= $count;
        }
        echo $show;
    }

//END AJAX



    public function client_add_cartt(Request $request){
        $product_id_cart = $request->product_id_detail;     /* tự đặt = re -> name input bên detail */
        $quantity_cart = $request->quantity_detail;         /* tự đặt = re -> name input bên detail */
        $product = Product::where('product_id',$product_id_cart)->first();


        /* Cart::add('293ad', 'Product 1', 1, 9.99,['size' => 'large']);
        return Redirect::to('/client_list_cart');  */
        /* Cart::add('293ad', 'Product 1', 1, 9.99); */
        /* Cart::destroy(); */

        $database['id'] = $product->product_id;                     /* biến CSDL */ /* database[id] của shopping cart echo Cart::add bên kia sẽ thấy*/
        $database['qty'] = $quantity_cart;                          /* biến đặt ở trên */
        $database['name'] = $product->product_name;
        $database['price'] = $product->product_price;
        $database['options']['image'] = $product->product_image;
        $packing = $request->packing_detail;

        Cart::add($database,['packing_cart' => $packing]);
        return Redirect::to('/client_list_cart');   /* trả về hàm */

        /* Cart::destroy(); */
    }

    public function client_add_cart(Request $request){
        Cart::destroy();
    }

    public function client_list_cart(Request $request){
        $url_canonical = $request->url();
        $category_product = CategoryProduct::where('category_product_status','1')->orderBy('category_product_id','desc')->get();
        return view('client.cart.client_list_cart')->with('category_product',$category_product)->with('url_canonical',$url_canonical);
    }
    public function client_delete_cart($rowId){
        Cart::update($rowId,0); /* đưa nó về số 0 */
        return Redirect::to('/client_list_cart');
    }
    public function client_update_cart(Request $request){
        $rowId = $request->cart_rowId;              //re -> name bên input list cart
        $quantity_update = $request->cart_quantity; //re -> name bên input list cart
        Cart::update($rowId,$quantity_update);
        return Redirect::to('/client_list_cart');
    }
}
