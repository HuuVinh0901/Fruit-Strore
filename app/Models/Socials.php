<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socials extends Model
{
    use HasFactory;
    /* public $timestamps = false;
    protected $fillable = [
          'social_provider_id',  'social_provider_name',  'social'
    ];
    protected $primaryKey = 'social_id';
    protected $table = 'socials';

    public function login(){
        return $this->belongsTo('App\Login', 'social');
    } */
    public $timestamps = false;
    protected $fillable = [
          'provider_user_id',  'provider',  'user'
    ];

    protected $primaryKey = 'user_id';
 	protected $table = 'social';
 	public function login(){
 		return $this->belongsTo('App\Login', 'user');
 	}


}
