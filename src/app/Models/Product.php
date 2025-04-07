<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'image_path', 'description'];

    public function seasons()
    {
        return $this->belongToMany(Season::class, 'product_season');
    }
}
