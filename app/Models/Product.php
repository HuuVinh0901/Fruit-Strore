<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = [
                            'product_name',
                            'product_image',
                            'product_summary',
                            'product_tag',
                            'product_detail',
                            'product_packing',
                            'product_price',
                            'product_sale',
                            'product_amount',
                            'product_sold',
                            'product_status',
                            'category_product_id',
                            'origin_id'];
    protected $primaryKey = 'product_id'; // id này = id dưới
    protected $table = 'product';

    function category_product(){
        return $this->belongsTo(CategoryProduct::class,'category_product_id'); /* 1 sản phẩm chỉ thuộc về 1 danh mục */
    }
    function origin(){
        return $this->belongsTo(Origin::class,'origin_id'); /* 1 sản phẩm chỉ thuộc về 1 danh mục */
    }
}
