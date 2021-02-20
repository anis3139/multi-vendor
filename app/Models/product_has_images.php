<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class product_has_images extends Model
{
    use HasFactory;
    public $table='product_has_images';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $keyType = 'int';
    public  $timestamps = false;


    public function image() {
        return $this->belongsTo(product_table::class,'has_images_product_id');
    }
}
