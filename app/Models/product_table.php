<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_table extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\product_table');
    }

}
