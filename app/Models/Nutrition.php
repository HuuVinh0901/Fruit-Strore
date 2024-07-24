<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['nutrition_title','nutrition_detail','nutrition_tag'];
    protected $primaryKey = 'nutrition_id'; // id này = id dưới
    protected $table = 'nutrition';
}
