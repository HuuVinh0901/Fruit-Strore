<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['client_email','client_password','client_name','client_phone'];
    protected $primaryKey = 'client_id'; // id này = id dưới
    protected $table = 'client';
}
