<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoOrder extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = [
                            'info_order_name',
                            'info_order_email',
                            'info_order_phone',
                            'province_id',
                            'district_id',
                            'ward_id',
                            'info_order_address',
                            'info_order_note'
                        ];
    protected $primaryKey = 'info_order_id'; // id này = id dưới
    protected $table = 'info_order';

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
