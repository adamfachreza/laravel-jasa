<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'detail_users';

    protected $fillable = [
        'service_id',
        'advantage'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function experience_user()
    {
        return $this->hasMany(ExperienceUser::class, 'detail_user_id');
    }
}
