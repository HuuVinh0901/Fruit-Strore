<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

use App\Models\Admin;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {               //xài bên admin
        Blade::if('hasrole', function($expression){     // hasrole tự đặt | expreesion là nhân viên bán hàng, nhân viên kho,...
            if(Auth::user()){                           //user bắt buộc tại là class có sẵn| nếu có đăng nhập
                if(Auth::user()->hasRole($expression)){ //
                    return true;                        // cho làm quyền
                }
            }
            return false;
        });

        //NHIỀU
        /* Blade::if('hasrole', function($expression){     // hasrole tự đặt | expreesion là nhân viên bán hàng, nhân viên kho,...
            if(Auth::user()){                           //user bắt buộc tại là class có sẵn| nếu có đăng nhập
                if(Auth::user()->hasAnyRole($expression)){ //
                    return true;                        // cho làm quyền
                }
            }
            return false;
        }); */
    }
}
