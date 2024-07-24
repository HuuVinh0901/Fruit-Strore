<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['province_name'];
    protected $primaryKey = 'province_id';
    protected $table = 'province';


}
