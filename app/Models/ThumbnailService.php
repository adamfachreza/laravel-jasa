<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThumbnailService extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'thumbnail_services';

    protected $fillable = [
        'thumbnail',
        'service_id'
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id','id');
    }

}
