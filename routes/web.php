<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvertiseController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryNewsController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentNewsController;
use App\Http\Controllers\CommentProductController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OriginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShipperController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StatisticalController;
use App\Http\Controllers\MailController;

//STRART_FROMTEND{
//client
Route::get('/',[PageController::class,'client_home_page']);
Route::get('/client_home_page',[PageController::class,'client_home_page']);

//news
Route::get('/client_list_news',[NewsController::class,'client_list_news']);
Route::get('/client_detail_news/{news_id}',[NewsController::class,'client_detail_news']);
Route::get('/client_category_news/{category_news_id}',[NewsController::class,'client_category_news']);

//comment_news
Route::post('/client_comment_news',[CommentNewsController::class,'client_comment_news']);
Route::post('/client_submit_comment_news',[CommentNewsController::class,'client_submit_comment_news']);

//product
Route::get('/client_list_product',[ProductController::class,'client_list_product']);
Route::get('/client_detail_product/{product_id}',[ProductController::class,'client_detail_product']);
Route::get('/client_category_product/{category_product_id}',[ProductController::class,'client_category_product']);
Route::get('/client_origin_product/{origin_id}',[ProductController::class,'client_origin_product']);
Route::post('/client_search_product',[ProductController::class,'client_search_product']);

Route::get('/client_like_product',[ProductController::class,'client_like_product']);
Route::post('/client_add_like_product',[ProductController::class,'client_add_like_product']);
Route::get('/client_delete_like_product/{session_id}',[ProductController::class,'client_delete_like_product']);
Route::get('/client_delete_all_like_product',[ProductController::class,'client_delete_all_like_product']);

Route::get('/client_price_product/{product_price}',[ProductController::class,'client_price_product']);
Route::get('/client_tag_product/{product_tag}',[ProductController::class,'client_tag_product']);
Route::post('/client_view_now_product',[ProductController::class,'client_view_now_product']);
    //sale
Route::get('/client_detail_sale_product/{product_id}',[ProductController::class,'client_detail_sale_product']);


//comment_product
Route::post('/client_comment_product',[CommentProductController::class,'client_comment_product']);
Route::post('/client_submit_comment_product',[CommentProductController::class,'client_submit_comment_product']);

//cart
Route::post('/client_add_cart',[CartController::class,'client_add_cart']);
Route::get('/client_list_cart',[CartController::class,'client_list_cart']);
Route::get('/client_delete_cart/{rowId}',[CartController::class,'client_delete_cart']);
Route::post('/client_update_cart',[CartController::class,'client_update_cart']); //không cần ID vì đã post bên kia
//cart_ajax
Route::post('/client_add_ajax_cart',[CartController::class,'client_add_ajax_cart']);
Route::get('/client_list_ajax_cart',[CartController::class,'client_list_ajax_cart']);
Route::get('/client_delete_ajax_cart/{session_id}',[CartController::class,'client_delete_ajax_cart']);
Route::post('/client_update_ajax_cart',[CartController::class,'client_update_ajax_cart']); //không cần ID vì đã post bên kia
Route::get('/client_delete_all_ajax_cart',[CartController::class,'client_delete_all_ajax_cart']); //không cần ID vì đã post bên kia

Route::get('/client_count_cart',[CartController::class,'client_count_cart']); //không cần ID vì đã post bên kia

//discount
Route::post('/client_check_discount',[DiscountController::class,'client_check_discount']);
Route::get('/client_delete_discount',[DiscountController::class,'client_delete_discount']);

//client
/* đăng nhập */
Route::get('/client_login_client',[ClientController::class,'client_login_client']);
Route::post('/client_submit_login_client',[ClientController::class,'client_submit_login_client']);
/* đăng ký */
Route::get('/client_register_client',[ClientController::class,'client_register_client']);
Route::post('/client_submit_register_client',[ClientController::class,'client_submit_register_client']);
/* đăng xuất */
Route::get('/client_logout_client',[ClientController::class,'client_logout_client']);
/* quên mật khẩu */
Route::get('/client_forget_client',[ClientController::class,'client_forget_client']);
Route::post('/client_submit_forget_client',[ClientController::class,'client_submit_forget_client']);
/* nhập mật khẩu mới */
Route::get('/client_new_password_client',[ClientController::class,'client_new_password_client']);
Route::post('/client_submit_new_password_client',[ClientController::class,'client_submit_new_password_client']);


/* đăng nhập google */
/* Route::get('/client_login_google_client',[ClientController::class,'client_login_google_client']); */
Route::get('/client_info_client/{client_id}',[ClientController::class,'client_info_client']);
Route::get('/client_edit_client/{client_id}',[ClientController::class,'client_edit_client']);
Route::post('/client_submit_edit_client/{client_id}',[ClientController::class,'client_submit_edit_client']);



//checkouts
Route::get('/client_login_checkout',[CheckoutController::class,'client_login_checkout']);
Route::post('/client_submit_login_checkout',[CheckoutController::class,'client_submit_login_checkout']);
Route::get('/client_register_checkout',[CheckoutController::class,'client_register_checkout']);
Route::post('/client_submit_register_checkout',[CheckoutController::class,'client_submit_register_checkout']);

Route::get('/client_checkout',[CheckoutController::class,'client_checkout']);
Route::post('/client_submit_min_300000_checkout',[CheckoutController::class,'client_submit_min_300000_checkout']);
Route::post('/client_submit_max_300000_checkout',[CheckoutController::class,'client_submit_max_300000_checkout']);

Route::post('/client_vnpay_checkout',[CheckoutController::class,'client_vnpay_checkout']);/* sau khi thanh toán vnpay */

Route::get('/client_submit_vnpay_checkout',[CheckoutController::class,'client_submit_vnpay_checkout']);/* sau khi thanh toán vnpay */
Route::get('/client_thank_vnpay_checkout',[CheckoutController::class,'client_thank_vnpay_checkout']);/* sau khi thanh toán vnpay */



//payment
Route::get('/client_checkout',[PaymentController::class,'client_list_payment']);

//delivery
Route::post('/client_select_delivery',[DeliveryController::class,'client_select_delivery']);
Route::post('/client_submit_delivery',[DeliveryController::class,'client_submit_delivery']);

//order
Route::get('/client_thank_order',[OrderController::class,'client_thank_order']);
Route::get('/client_detail_order/{order_code}',[OrderController::class,'client_detail_order']);
Route::get('/client_history_order',[OrderController::class,'client_history_order']);
Route::post('/client_cancel_order',[OrderController::class,'client_cancel_order']);

//health
Route::get('/client_list_health',[HealthController::class,'client_list_health']);







//}END_CLIENT

//------------------------------------------------------------------------------------------------------------------------------------


//START_ADMIN{
//backend
Route::get('/admin_login_admin',[AdminController::class,'admin_login_admin']);
Route::get('/admin_logout_admin',[AdminController::class,'admin_logout_admin']);

//advertise
Route::group(['middleware'=>'role'],function(){
    Route::get('/admin_list_advertise',[AdvertiseController::class,'admin_list_advertise']);

    Route::get('/admin_add_advertise',[AdvertiseController::class,'admin_add_advertise']);
    Route::post('/admin_submit_add_advertise',[AdvertiseController::class,'admin_submit_add_advertise']);

    Route::get('/admin_edit_advertise/{advertise_id}',[AdvertiseController::class,'admin_edit_advertise']);
    Route::post('/admin_update_edit_advertise/{advertise_id}',[AdvertiseController::class,'admin_update_edit_advertise']);

    Route::get('/admin_display_advertise/{advertise_id}',[AdvertiseController::class,'admin_display_advertise']);/* dường dẫn/tên là tham số trong hàm , controller@hàm */
    Route::get('/admin_undisplay_advertise/{advertise_id}',[AdvertiseController::class,'admin_undisplay_advertise']);


    //origin
    Route::get('/admin_add_origin',[OriginController::class,'admin_add_origin']);
    Route::get('/admin_list_origin',[OriginController::class,'admin_list_origin']);
    Route::get('/admin_edit_origin/{origin_id}',[OriginController::class,'admin_edit_origin']);
    Route::get('/admin_delete_origin/{origin_id}',[OriginController::class,'admin_delete_origin']);

    Route::post('/admin_submit_add_origin',[OriginController::class,'admin_submit_add_origin']);
    Route::post('/admin_update_edit_origin/{origin_id}',[OriginController::class,'admin_update_edit_origin']);

    Route::get('/admin_display_origin/{origin_id}',[OriginController::class,'admin_display_origin']);/* dường dẫn/tên là tham số trong hàm , controller@hàm */
    Route::get('/admin_undisplay_origin/{origin_id}',[OriginController::class,'admin_undisplay_origin']);

    //category_product
    Route::get('/admin_add_category_product',[CategoryProductController::class,'admin_add_category_product']);
    Route::get('/admin_list_category_product',[CategoryProductController::class,'admin_list_category_product']);
    Route::get('/admin_edit_category_product/{category_product_id}',[CategoryProductController::class,'admin_edit_category_product']);
    Route::get('/admin_delete_category_product/{category_product_id}',[CategoryProductController::class,'admin_delete_category_product']);

    Route::post('/admin_submit_add_category_product',[CategoryProductController::class,'admin_submit_add_category_product']);
    Route::post('/admin_update_edit_category_product/{category_product_id}',[CategoryProductController::class,'admin_update_edit_category_product']);

    Route::get('/admin_display_category_product/{category_product_id}',[CategoryProductController::class,'admin_display_category_product']);/* dường dẫn/tên là tham số trong hàm , controller@hàm */
    Route::get('/admin_undisplay_category_product/{category_product_id}',[CategoryProductController::class,'admin_undisplay_category_product']);


    //category_news
    Route::get('/admin_add_category_news',[CategoryNewsController::class,'admin_add_category_news']);
    Route::get('/admin_list_category_news',[CategoryNewsController::class,'admin_list_category_news']);
    Route::get('/admin_edit_category_news/{category_news_id}',[CategoryNewsController::class,'admin_edit_category_news']);
    Route::get('/admin_delete_category_news/{category_news_id}',[CategoryNewsController::class,'admin_delete_category_news']);

    Route::post('/admin_submit_add_category_news',[CategoryNewsController::class,'admin_submit_add_category_news']);
    Route::post('/admin_update_edit_category_news/{category_news_id}',[CategoryNewsController::class,'admin_update_edit_category_news']);

    Route::get('/admin_display_category_news/{category_news_id}',[CategoryNewsController::class,'admin_display_category_news']);/* dường dẫn/tên là tham số trong hàm , controller@hàm */
    Route::get('/admin_undisplay_category_news/{category_news_id}',[CategoryNewsController::class,'admin_undisplay_category_news']);


    //brand
    Route::get('/admin_add_brand',[BrandController::class,'admin_add_brand']);
    Route::get('/admin_list_brand',[BrandController::class,'admin_list_brand']);
    Route::get('/admin_edit_brand/{brand_id}',[BrandController::class,'admin_edit_brand']);
    Route::get('/admin_delete_brand/{brand_id}',[BrandController::class,'admin_delete_brand']);

    Route::post('/admin_submit_add_brand',[BrandController::class,'admin_submit_add_brand']);
    Route::post('/admin_update_edit_brand/{brand_id}',[BrandController::class,'admin_update_edit_brand']);

    Route::get('/admin_display_brand/{brand_id}',[BrandController::class,'admin_display_brand']);/* dường dẫn/tên là tham số trong hàm , controller@hàm */
    Route::get('/admin_undisplay_brand/{brand_id}',[BrandController::class,'admin_undisplay_brand']);


    //product
    Route::get('/admin_add_product',[ProductController::class,'admin_add_product']);/* ->middleware('role') có quyền mới đc */
    Route::post('/admin_submit_add_product',[ProductController::class,'admin_submit_add_product']);

    Route::get('/admin_list_product',[ProductController::class,'admin_list_product']);
    Route::get('/admin_detail_product/{product_id}',[ProductController::class,'admin_detail_product']);
    Route::get('/admin_delete_product/{product_id}',[ProductController::class,'admin_delete_product']);

    Route::get('/admin_edit_product/{product_id}',[ProductController::class,'admin_edit_product']);
    Route::post('/admin_update_edit_product/{product_id}',[ProductController::class,'admin_update_edit_product']);

    Route::get('/admin_display_product/{product_id}',[ProductController::class,'admin_display_product']);/* dường dẫn/tên là tham số trong hàm , controller@hàm */
    Route::get('/admin_undisplay_product/{product_id}',[ProductController::class,'admin_undisplay_product']);

        //sale_product
    Route::get('/admin_add_sale_product/{product_id}',[ProductController::class,'admin_add_sale_product']);/* ->middleware('role') có quyền mới đc */
    Route::post('/admin_add_submit_sale_product/{product_id}',[ProductController::class,'admin_add_submit_sale_product']);

    Route::get('/admin_edit_sale_product/{product_id}',[ProductController::class,'admin_edit_sale_product']);/* ->middleware('role') có quyền mới đc */
    Route::post('/admin_edit_update_sale_product/{product_id}',[ProductController::class,'admin_edit_update_sale_product']);

    Route::get('/admin_delete_sale_product/{product_id}',[ProductController::class,'admin_delete_sale_product']);

        //product_amount
    Route::post('/admin_add_amount_product',[ProductController::class,'admin_add_amount_product']);


    //comment_product
    Route::get('/admin_list_comment_product',[CommentProductController::class,'admin_list_comment_product']);
    Route::post('/admin_reply_comment_product',[CommentProductController::class,'admin_reply_comment_product']);
    Route::get('/admin_delete_comment_product/{comment_product_id}',[CommentProductController::class,'admin_delete_comment_product']);

    //comment_news
    Route::get('/admin_list_comment_news',[CommentNewsController::class,'admin_list_comment_news']);
    Route::post('/admin_reply_comment_news',[CommentNewsController::class,'admin_reply_comment_news']);
    Route::get('/admin_delete_comment_news/{comment_news_id}',[CommentNewsController::class,'admin_delete_comment_news']);

    //gallery
    Route::get('/admin_add_gallery/{product_id}',[GalleryController::class,'admin_add_gallery']);
    Route::post('/admin_list_gallery',[GalleryController::class,'admin_list_gallery']);
    Route::post('/admin_submit_add_gallery/{product_id}',[GalleryController::class,'admin_submit_add_gallery']);
    Route::post('/admin_delete_gallery',[GalleryController::class,'admin_delete_gallery']);



    //news
    Route::get('/admin_add_news',[NewsController::class,'admin_add_news']);
    Route::post('/admin_submit_add_news',[NewsController::class,'admin_submit_add_news']);

    Route::get('/admin_list_news',[NewsController::class,'admin_list_news']);
    Route::get('/admin_delete_news/{news_id}',[NewsController::class,'admin_delete_news']);

    Route::get('/admin_edit_news/{news_id}',[NewsController::class,'admin_edit_news']);
    Route::post('/admin_update_edit_news/{news_id}',[NewsController::class,'admin_update_edit_news']);

    Route::get('/admin_display_news/{news_id}',[NewsController::class,'admin_display_news']);/* dường dẫn/tên là tham số trong hàm , controller@hàm */
    Route::get('/admin_undisplay_news/{news_id}',[NewsController::class,'admin_undisplay_news']);

    Route::get('/admin_detail_news/{news_id}',[NewsController::class,'admin_detail_news']);


    //order
    Route::get('/admin_list_order',[OrderController::class,'admin_list_order']);
    Route::get('/admin_detail_order/{order_code}',[OrderController::class,'admin_detail_order']);
    Route::get('/admin_delete_order/{order_code}',[OrderController::class,'admin_delete_order']);

    Route::get('/admin_update_status_order/{order_code}',[OrderController::class,'admin_update_status_order']);
    Route::post('/admin_submit_update_status_order/{order_code}',[OrderController::class,'admin_submit_update_status_order']);

    Route::post('/admin_update_status_detail_order',[OrderController::class,'admin_update_status_detail_order']);

    Route::get('/admin_shipper_order/{order_code}',[OrderController::class,'admin_shipper_order']);
    Route::post('/admin_submit_shipper_order/{order_code}',[OrderController::class,'admin_submit_shipper_order']);
        //shipper_detai
    Route::get('/admin_shipper_detail_order/{order_code}',[OrderController::class,'admin_shipper_detail_order']);
    Route::post('/admin_submit_shipper_detail_order/{order_code}',[OrderController::class,'admin_submit_shipper_detail_order']);

    Route::get('/admin_print_order/{order_code}',[OrderController::class,'admin_print_order']);


    //payment method
    Route::get('/admin_add_payment',[PaymentController::class,'admin_add_payment']);
    Route::get('/admin_list_payment',[PaymentController::class,'admin_list_payment']);
    Route::get('/admin_edit_payment/{payment_id}',[PaymentController::class,'admin_edit_payment']);
    Route::get('/admin_delete_payment/{payment_id}',[PaymentController::class,'admin_delete_payment']);

    Route::post('/admin_submit_add_payment',[PaymentController::class,'admin_submit_add_payment']);
    Route::post('/admin_update_edit_payment/{payment_id}',[PaymentController::class,'admin_update_edit_payment']);

    Route::get('/admin_display_payment/{payment_id}',[PaymentController::class,'admin_display_payment']);/* dường dẫn/tên là tham số trong hàm , controller@hàm */
    Route::get('/admin_undisplay_payment/{payment_id}',[PaymentController::class,'admin_undisplay_payment']);


    //discount
    Route::get('/admin_add_discount',[DiscountController::class,'admin_add_discount']);
    Route::get('/admin_list_discount',[DiscountController::class,'admin_list_discount']);
    Route::get('/admin_delete_discount/{discount_id}',[DiscountController::class,'admin_delete_discount']);

    Route::post('/admin_submit_add_discount',[DiscountController::class,'admin_submit_add_discount']);


    //delivery
    Route::get('/admin_add_delivery',[DeliveryController::class,'admin_add_delivery']);
    Route::post('/admin_submit_add_delivery',[DeliveryController::class,'admin_submit_add_delivery']);
    Route::post('/admin_select_delivery',[DeliveryController::class,'admin_select_delivery']);
    Route::post('/admin_list_delivery',[DeliveryController::class,'admin_list_delivery']);
    Route::post('/admin_edit_delivery',[DeliveryController::class,'admin_edit_delivery']);



    //client
    Route::get('/admin_list_client',[ClientController::class,'admin_list_client']);
    Route::get('/admin_delete_client/{client_id}',[ClientController::class,'admin_delete_client']);
    Route::get('/admin_list_order_client/{client_id}',[ClientController::class,'admin_list_order_client']);





    //order_statistical
    Route::get('/admin_order_statistical',[StatisticalController::class,'admin_order_statistical']);
    Route::post('/admin_submit_order_statistical',[StatisticalController::class,'admin_submit_order_statistical']);
    Route::post('/admin_filter_order_statistical',[StatisticalController::class,'admin_filter_order_statistical']);
    Route::post('/admin_show_30days_order_statistical',[StatisticalController::class,'admin_show_30days_order_statistical']);


    //revenue_statistical
    Route::get('/admin_revenue_statistical',[StatisticalController::class,'admin_revenue_statistical']);
    Route::post('/admin_submit_revenue_statistical',[StatisticalController::class,'admin_submit_revenue_statistical']);
    Route::post('/admin_submit_date_revenue_statistical',[StatisticalController::class,'admin_submit_date_revenue_statistical']);
    Route::post('/admin_show_all_revenue_statistical',[StatisticalController::class,'admin_show_all_revenue_statistical']);


    //cost
    Route::get('/admin_add_cost',[CostController::class,'admin_add_cost']);/* ->middleware('role') có quyền mới đc */
    Route::post('/admin_submit_add_cost',[CostController::class,'admin_submit_add_cost']);

    Route::get('/admin_list_cost',[CostController::class,'admin_list_cost']);
    Route::get('/admin_delete_cost/{cost_id}',[CostController::class,'admin_delete_cost']);

    Route::get('/admin_edit_cost/{cost_id}',[CostController::class,'admin_edit_cost']);
    Route::post('/admin_update_edit_cost/{cost_id}',[CostController::class,'admin_update_edit_cost']);


    //nutrition
    Route::get('/admin_add_nutrition',[NutritionController::class,'admin_add_nutrition']);/* ->middleware('role') có quyền mới đc */
    Route::post('/admin_submit_add_nutrition',[NutritionController::class,'admin_submit_add_nutrition']);

    Route::get('/admin_list_nutrition',[NutritionController::class,'admin_list_nutrition']);
    Route::get('/admin_detail_nutrition/{nutrition_id}',[NutritionController::class,'admin_detail_nutrition']);
    Route::get('/admin_delete_nutrition/{nutrition_id}',[NutritionController::class,'admin_delete_nutrition']);

    Route::get('/admin_edit_nutrition/{nutrition_id}',[NutritionController::class,'admin_edit_nutrition']);
    Route::post('/admin_update_edit_nutrition/{nutrition_id}',[NutritionController::class,'admin_update_edit_nutrition']);
});
Route::get('/admin_detail_order/{order_code}',[OrderController::class,'admin_detail_order']);

//staff
Route::group(['middleware'=>'role'],function(){
    Route::get('/admin_create_staff',[StaffController::class,'admin_create_staff']);
    Route::post('/admin_submit_create_staff',[StaffController::class,'admin_submit_create_staff']);
    Route::get('/admin_logout_staff',[StaffController::class,'admin_logout_staff']);
    Route::get('/admin_list_staff',[StaffController::class,'admin_list_staff']);//role bên kernel
    Route::post('/admin_allow_role_staff',[StaffController::class,'admin_allow_role_staff']);
    Route::get('/admin_delete_staff/{admin_id}',[StaffController::class,'admin_delete_staff']);
});

Route::get('/admin_login_staff',[StaffController::class,'admin_login_staff']);
Route::post('/admin_submit_login_staff',[StaffController::class,'admin_submit_login_staff']);



//shippper
Route::get('/admin_login_shipper',[ShipperController::class,'admin_login_shipper']);
Route::post('/admin_submit_login_shipper',[ShipperController::class,'admin_submit_login_shipper']);

Route::get('/admin_list_order_shipper',[ShipperController::class,'admin_list_order_shipper']);
Route::get('/admin_detail_order_shipper/{order_code}',[ShipperController::class,'admin_detail_order_shipper']);

Route::post('/admin_update_status_order_shipper',[ShipperController::class,'admin_update_status_order_shipper']);

//}END_BACKEND


//MAIL
Route::get('/send_email',[ClientController::class,'send_email']);/* dường dẫn/tên là tham số trong hàm , controller@hàm */

Route::get('/admin_vip_discount_mail/{discount_code}/{discount_name}/{discount_amount}/{discount_category}/{discount_be}/{discount_start}/{discount_end}',[MailController::class,'admin_vip_discount_mail']);
Route::get('/admin_discount_mail/{discount_code}/{discount_name}/{discount_amount}/{discount_category}/{discount_be}/{discount_start}/{discount_end}',[MailController::class,'admin_discount_mail']);

//FACEBOOK
Route::get('/admin_login_facebook_admin',[AdminController::class,'admin_login_facebook_admin']);
Route::get('/callback',[AdminController::class,'callback']);
Route::get('/login_facebook',[AdminController::class,'login_facebook']);
Route::get('/callback_facebook',[AdminController::class,'callback_facebook']);


//tìm kiếm
Route::get('/product/{product_id}',[ProductController::class,'show']);
Route::get('/search/product_name',[ProductController::class,'searchByName']);
Route::get('/search/product_price',[ProductController::class,'searchByPrice']);
Route::get('/search/category_product_name',[ProductController::class,'searchByCategory']);
Route::get('/search/origin_name',[ProductController::class,'searchByOrigin']);

//tìm kiếm dinh dưỡng
Route::get('/nutrition/{nutrition_id}',[NutritionController::class,'client_show_nutrition']);
Route::get('/search/nutrition_tag',[NutritionController::class,'client_search_nutrition']);
Route::get('/client_list_nutrition/{tag_search}',[NutritionController::class,'client_list_nutrition']);
Route::get('/client_home_nutrition',[NutritionController::class,'client_home_nutrition']);


//dinh dưỡng
/* Route::get('/client_list_nutrition',[NutritionController::class,'index']);

Route::get('/client_list_nutrition/{tag}',[NutritionController::class,'show']); */


