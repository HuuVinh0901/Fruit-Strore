<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Discount;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class MailController extends Controller
{
    /* Gửi mã khuyến mãi cho khách hàng vip */
    public function admin_vip_discount_mail($discount_code,$discount_name,$discount_amount,$discount_category,$discount_be,$discount_start,$discount_end){
        $client_vip = Client::where('client_vip','=',1)->get();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');
        $title_mail = "Ưu đãi dành cho khách VIP từ trái cây nhập khẩu ImportedFruit".' '.$today;
        $data = [];
        foreach($client_vip as $vip){
            $data['email'][] = $vip->client_email;
        }
        $discount = Discount::where('discount_code',$discount_code);
        $discount = array(
                            'discount_code' => $discount_code,
                            'discount_name' => $discount_name,
                            'discount_amount' => $discount_amount,
                            'discount_category' => $discount_category,
                            'discount_be' => $discount_be,
                            'discount_start' => $discount_start,
                            'discount_end' => $discount_end);
        Mail::send('admin.mail.admin_vip_discount_mail', ['discount'=>$discount], function ($message) use ($data,$title_mail){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
        });
        return Redirect()->back()->with('message','Gửi mã khuyến mãi đến khách hàng vip thành công');
    }


    /* Gửi mã khuyến mãi cho khách hàng */
    public function admin_discount_mail($discount_code,$discount_name,$discount_amount,$discount_category,$discount_be,$discount_start,$discount_end){
        $client = Client::where('client_vip','=',0)->get();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');
        $title_mail = "Mã khuyến mãi danh cho bạn từ trái cây nhập khẩu ImportedFruit".' '.$today;
        $data = [];
        foreach($client as $none){
            $data['email'][] = $none->client_email;
        }
        $discount = array(
                            'discount_code' => $discount_code,
                            'discount_name' => $discount_name,
                            'discount_amount' => $discount_amount,
                            'discount_category' => $discount_category,
                            'discount_be' => $discount_be,
                            'discount_start' => $discount_start,
                            'discount_end' => $discount_end);
        Mail::send('admin.mail.admin_discount_mail', ['discount'=>$discount], function ($message) use ($data,$title_mail){
            $message->from($data['email'],$title_mail);
            $message->to($data['email'])->subject($title_mail);
        });
        return Redirect()->back()->with('message','Gửi mã khuyến mãi đến khách hàng thành công');
    }


}
