<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemimage extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'image_id',
        'url',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
