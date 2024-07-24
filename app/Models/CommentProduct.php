<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentProduct extends Model
{
    use HasFactory;
    public $timetamps = false;
    protected $fillable = ['product_id','client_id','comment_product_detail','comment_product_reply','created_at'];
    protected $primaryKey = 'comment_product_id';
    protected $table = 'comment_product';

    function product(){
        return $this->belongsTo(Product::class,'product_id'); /* 1 sản phẩm chỉ thuộc về 1 danh mục */
    }

    function client(){
        return $this->belongsTo(Client::class,'client_id'); //1 đơn hàng chỉ thuộc về 1 khách hàng
    }
}
