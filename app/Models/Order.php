<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'buyer_id','freelancer_id','service_id',
        'file','note','expired','order_status_id',
    ];

    protected $dates = [
        'deleted_id','updated_id','created_at'
    ];
}
