<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class product_table extends Model
{
    use HasFactory;
    public $table='product_tables';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $keyType = 'int';
    public  $timestamps = false;


    public function category() {
        return $this->belongsTo(ProductsCategoryModel::class,'product_category_id');
    }

    public function getCategory() {
        return $this->belongsTo(ProductsCategoryModel::class, 'product_category_id', 'id');
    }


    public function brand() {
        return $this->belongsTo(ProductsBrandModel::class,'product_brand_id');
    }
    public function getBrand() {
        return $this->belongsTo(ProductsBrandModel::class,'product_brand_id', 'id');
    }


    public function vendor() {
        return $this->belongsTo(Vendor::class,'product_owner_id', 'id');
    }

    public function image() {
        return $this->hasMany(product_has_images::class,'has_images_product_id', 'id');
    }

    public function maserment() {
        return $this->hasMany(meserments::class,'product_id', 'id');
    }

    public function color() {
        return $this->hasMany(product_color::class,'product_color_product_id', 'id');
    }

    public function img() {
        return $this->hasMany(product_has_images::class,'has_images_product_id', 'id');
    }

    public function cat() {
        return $this->belongsTo(ProductsCategoryModel::class,'product_category_id', 'id');
    }



    public function orderproduct() {
        return $this->belongsTo(OrderProducts::class,'product_id', 'id');
    }

    public function masermant() {
        return $this->hasMany(meserments::class,'product_measurements_id');
    }


    public function reviews()
    {
        return $this->hasMany(ReatingReview::class, 'product_id','id');
    }


}
