<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class product_color extends Model
{
    use HasFactory;
    public $table='product_colors';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $keyType = 'int';
    public  $timestamps = false;

    public function image() {
        return $this->belongsTo(product_table::class,'product_color_product_id');
    }
}
