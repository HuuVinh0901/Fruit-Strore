<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusShipper extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['status_shipper_name'];
    protected $primaryKey = 'status_shipper_id'; // id này = id dưới
    protected $table = 'status_shipper';
}
