<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    public $table='orders';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $keyType = 'int';
    public  $timestamps = false;

    public function customer() {
        return $this->belongsTo(users::class,'user_id');
    }

    public function processor() {
        return $this->hasOne(admins::class,'user_id');
    }

    public function owner() {
        return $this->belongsTo(vendors::class,'product_owner_id');
    }

    public function product() {
        return $this->hasMany(OrderProducts::class,'order_id', 'id');
    }


    public function orderProducts() {
        return $this->hasMany(OrderProducts::class,'order_id', 'id');
    }






}
