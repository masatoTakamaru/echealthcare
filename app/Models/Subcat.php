<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcat extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'name',
    ];

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
