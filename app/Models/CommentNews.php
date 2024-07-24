<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentNews extends Model
{
    use HasFactory;
    public $timetamps = false;
    protected $fillable = ['news_id','client_id','comment_news_detail','comment_news_reply','created_at'];
    protected $primaryKey = 'comment_news_id';
    protected $table = 'comment_news';

    function news(){
        return $this->belongsTo(News::class,'news_id'); /* 1 sản phẩm chỉ thuộc về 1 danh mục */
    }

    function client(){
        return $this->belongsTo(Client::class,'client_id'); //1 đơn hàng chỉ thuộc về 1 khách hàng
    }
}
