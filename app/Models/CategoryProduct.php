<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['category_product_name','category_product_status'];
    protected $primaryKey = 'category_product_id'; // id này = id dưới
    protected $table = 'category_product';
    // public function product() : Returntype {
    //     $this->hasMany('App\Product','category_prodcut_id);                  // thì lấy sản phẩm ra dựa trên danh mục đó
                                                    // 1 sản phẩm thuộc 1 thương hiệu belongsTo
                                                    // 1 thương hiệu có nhiều sản phẩm hasMany
    // }
    function product(){
        return $this->hasMany(Product::class,'category_product_id'); //1 danh mục có 1 hoặc nhiều sản phẩm
    }
}
