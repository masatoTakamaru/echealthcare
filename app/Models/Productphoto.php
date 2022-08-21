<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productphoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'url',
        'is_main',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
