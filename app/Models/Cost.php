<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    public $timetamps = false;
    protected $fillable = ['product_id','cost_buy'];
    protected $primaryKey = 'cost_id';
    protected $table = 'cost';

    public function product(){
        return $this->belongsTo(Product::class,'product_id'); //1:1
    }


}
