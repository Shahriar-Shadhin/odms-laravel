<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_info extends Model
{
    use HasFactory;
    protected $guarded = [];
    // public $incrementing = false;
    protected $primaryKey = 'si';
    public $timestamps = false;

}
