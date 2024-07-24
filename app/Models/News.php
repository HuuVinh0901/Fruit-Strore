<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['news_title','category_news_id','news_image','news_summary','news_content','news_status','created_at'];
    protected $primaryKey = 'news_id'; // id này = id dưới
    protected $table = 'news';

    function category_news(){
        return $this->belongsTo(CategoryNews::class,'category_news_id'); /* 1 sản phẩm chỉ thuộc về 1 danh mục */
    }
}
