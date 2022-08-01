<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvantageService extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'advantage_services';

    protected $fillable = [
        'service_id','advantage'
    ];

    protected $dates = [
        'deleted_at','created_at','updated_at'
    ];

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id','id');
    }

}
