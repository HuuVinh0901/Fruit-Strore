<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = [
                            'client_name',
                            'client_email',
                            'client_phone',
                            'client_password',
                            'province_id',
                            'district_id',
                            'ward_id',
                            'client_address',
                            'client_vip',
                            'client_token'];
    protected $primaryKey = 'client_id'; // id này = id dưới
    protected $table = 'client';

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
