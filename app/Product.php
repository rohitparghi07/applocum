<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'image',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Product::class,'category_id','id');
    }
}
