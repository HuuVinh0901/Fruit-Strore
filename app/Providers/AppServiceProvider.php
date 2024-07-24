<?php

namespace App\Providers;

use App\Models\Nutrition;
use Illuminate\Support\ServiceProvider;

use App\Models\Product;
use App\Models\CategoryProduct;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void

    {
        view()->composer('*',function($view){
            /* lọc ở danh sách */
            $min_product_price = Product::where('product_status',1)->min('product_price');
            $max_product_price = Product::where('product_status',1)->max('product_price');

            $min_amount = 0;
            $max_amount = $max_product_price + 20000;


            /* lọc ở tag */
            $max_product_price_tag = Product::where('product_status',1)->max('product_price');

            $min_amount_tag = 0;
            $max_amount_tag = $max_product_price_tag + 20000;


            /*lọc ở origin */
            $max_product_price_origin = Product::where('product_status',1)->max('product_price');

            $min_amount_origin = 0;
            $max_amount_origin = $max_product_price_origin + 20000;

            /* lọc ở category */
            $max_product_price_category = Product::where('product_status',1)->max('product_price');

            $min_amount_category = 0;
            $max_amount_category = $max_product_price_category + 20000;

            $nutritions = Nutrition::all();
            $category_product = CategoryProduct::all();

            $view->with('min_product_price',$min_product_price)
                    ->with('max_product_price',$max_product_price)
                    ->with('min_amount',$min_amount)
                    ->with('max_amount',$max_amount)

                    ->with('nutritions',$nutritions)

                    ->with('category_product',$category_product)

                    ->with('min_amount_category',$min_amount_category)
                    ->with('max_amount_category',$max_amount_category)

                    ->with('min_amount_origin',$min_amount_origin)
                    ->with('max_amount_origin',$max_amount_origin)

                    ->with('min_amount_tag',$min_amount_tag)
                    ->with('max_amount_tag',$max_amount_tag)
                    ;


        });
    }
}
