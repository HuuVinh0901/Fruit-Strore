<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['province_id','district_name'];
    protected $primaryKey = 'district_id';
    protected $table = 'district';

}
