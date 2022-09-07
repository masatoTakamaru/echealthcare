<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
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

    public function itemimages()
    {
        return $this->hasMany(Itemimage::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

}
