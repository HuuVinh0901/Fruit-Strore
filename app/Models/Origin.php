<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['origin_name','origin_status'];
    protected $primaryKey = 'origin_id'; // id này = id dưới
    protected $table = 'origin';
    function news(){
        return $this->hasMany(Product::class,'category_product_id'); //1 danh mục có nhiều hoặc 1 bài viết
    }
}
