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

    public function itemphotos()
    {
        return $this->hasMany(Itemphoto::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

}
