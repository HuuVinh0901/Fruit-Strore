<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['province_id','district_id','ward_id','delivery_fee'];
    protected $primaryKey = 'delivery_id';
    protected $table = 'delivery';

    function ward(){
        return $this->belongsTo(Ward::class,'ward_id'); //không hiểu chỗ này nha
    }

    function district(){
        return $this->belongsTo(District::class,'district_id'); //không hiểu chỗ này nha
    }

    function province(){
        return $this->belongsTo(Province::class,'province_id'); //không hiểu chỗ này nha
    }
}
