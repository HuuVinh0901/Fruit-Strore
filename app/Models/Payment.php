<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['payment_method','payment_status'];
    protected $primaryKey = 'payment_id'; // id này = id dưới
    protected $table = 'payment';
}
