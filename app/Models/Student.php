<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timetamps = false; // created_at
    protected $fillable = ['name','email','student_code'];
    protected $primaryKey = 'id';
    protected $table = 'students';
}
