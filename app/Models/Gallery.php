<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['product_id','gallery_name','gallery_image'];
    protected $primaryKey = 'gallery_id'; // id này = id dưới
    protected $table = 'gallery';
}
