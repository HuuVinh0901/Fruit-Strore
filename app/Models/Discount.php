<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = [
                            'discount_code',
                            'discount_name',
                            'discount_amount',
                            'discount_category',
                            'discount_be',
                            'discount_start',
                            'discount_end',
                            'discount_client'
                        ];
    protected $primaryKey = 'discount_id'; // id này = id dưới
    protected $table = 'discount';
}
