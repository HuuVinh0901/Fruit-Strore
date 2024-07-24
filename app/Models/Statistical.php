<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = [
                            'statistical_order_date',
                            'statistical_price_sell',
                            'statistical_cost_buy',
                            'statistical_profit',
                            'statistical_product_quantity',
                            'statistical_order_quantity',
                        ];
    protected $primaryKey = 'statistical_id'; // id này = id dưới
    protected $table = 'statistical';

    /* use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['order_date','sales','profit','quantity','total_order'];
    protected $primaryKey = 'id_statistical'; // id này = id dưới
    protected $table = 'tbl_statistical'; */
}
