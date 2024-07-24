<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use HasFactory;
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['order_code','money_product','money_discount','delivery_fee','money_total'];
    protected $primaryKey = 'money_id'; // id này = id dưới
    protected $table = 'money';
}
