<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['brand_name','brand_address','brand_phone','brand_status'];
    protected $primaryKey = 'brand_id'; // id này = id dưới
    protected $table = 'brand';
}
