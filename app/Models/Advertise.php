<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['advertise_name','advertise_image','advertise_detail','advertise_status'];
    protected $primaryKey = 'advertise_id'; // id này = id dưới
    protected $table = 'advertise';
}
