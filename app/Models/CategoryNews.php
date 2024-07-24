<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNews extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['category_news_name','category_news_status'];
    protected $primaryKey = 'category_news_id'; // id này = id dưới
    protected $table = 'category_news';
    function news(){
        return $this->hasMany(News::class,'category_news_id'); //1 danh mục có nhiều hoặc 1 bài viết
    }
}
