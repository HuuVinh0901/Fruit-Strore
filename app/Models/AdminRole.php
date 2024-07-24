<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['admin_admin_id','role_role_id'];
    protected $primaryKey = 'admin_role_id'; // id này = id dưới
    protected $table = 'admin_role';

    public function admin(){
        return $this->belongsTo(Admin::class);
        /* return $this->belongsToMany('App\Models\Role'); */
    }
}
