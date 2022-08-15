<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'name',
        'serial',
        'price',
        'inventory',
        'spec',
        'cat_id',
        'subcat_id',
        'maker',
    ];

    public function subcat()
    {
        return $this->belongsTo(Subcat::class);
    }

    public function productphotos()
    {
        return $this->hasMany(Productphoto::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

}
