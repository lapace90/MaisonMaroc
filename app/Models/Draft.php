<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'photo', 'user_id', 'type', 'duration', 'image'
    ];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'draft_dish', 'draft_id', 'dish_id');
    }
}