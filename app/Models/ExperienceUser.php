<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienceUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'experience_users';

    protected $fillable = [
        'detail_user_id',
        'role'
    ];

    protected $dates = [
        'deleted_at','created_at','updated_at'
    ];
}
