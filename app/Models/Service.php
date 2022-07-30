<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'users_id','title','description','delivery_time','price','note'
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
