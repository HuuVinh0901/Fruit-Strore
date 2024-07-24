<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/* use Laravel\Sanctum\HasApiTokens; */


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['admin_email','admin_password','admin_name','admin_phone'];
    protected $primaryKey = 'admin_id'; // id này = id dưới
    protected $table = 'admin';

    public function role(){
        return $this->belongsToMany(Role::class);
        /* return $this->belongsToMany('App\Models\Role'); */
    }

    public function getAuthPassword(){
        return $this->admin_password;
    }

    public function hasAnyRole($role){
        return null !== $this->role()->whereIn('role_name',$role)->first();
    }

    public function hasRole($role){
        return null !== $this->role()->where('role_name',$role)->first();
    }
}

/* class Admins extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['admin_email','admin_password','admin_name','admin_phone'];
    protected $primaryKey = 'admin_id'; // id này = id dưới
    protected $table = 'admins';

    public function role(){
        return $this->belongsToMany('App\Models\Roles');
    }
} */
