<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'image',
        'description',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
