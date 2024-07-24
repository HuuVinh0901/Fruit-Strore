<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    public $timetamps = false;
    protected $fillable = ['order_code','product_id','product_name','product_packing','product_price','product_quantity'];
    protected $primaryKey = 'detail_order_id'; // id này = id dưới
    protected $table = 'detail_order';

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id'); //1:1
    }
}
