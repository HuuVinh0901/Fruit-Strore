<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['order_code','client_id','info_order_id','payment_id','discount_code','delivery_fee','order_total','status_id','order_date','created_at','admin_id'];
    protected $primaryKey = 'order_id'; // id này = id dưới
    protected $table = 'order';

    function client(){
        return $this->belongsTo(Client::class,'client_id'); //1 đơn hàng chỉ thuộc về 1 khách hàng
    }

    function status(){
        return $this->belongsTo(Status::class,'status_id'); //1 đơn hàng có nhiều trạng thái đặt hàng
    }

    function payment(){
        return $this->belongsTo(Payment::class,'payment_id'); //1 danh mục có nhiều hoặc 1 sản phẩm
    }

    function info_order(){
        return $this->belongsTo(InfoOrder::class,'info_order_id'); //1 danh mục có nhiều hoặc 1 sản phẩm
    }

    function admin(){
        return $this->belongsTo(Admin::class,'admin_id'); //1 danh mục có nhiều hoặc 1 sản phẩm
    }

    function status_shipper(){
        return $this->belongsTo(StatusShipper::class,'status_shipper_id'); //1 danh mục có nhiều hoặc 1 sản phẩm
    }
}
