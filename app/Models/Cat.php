<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function subcats()
    {
        return $this->hasMany(Subcat::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
