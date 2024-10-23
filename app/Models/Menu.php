<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'photo',
        'status',
    ];

    // Définir la relation Many-to-Many avec les plats
    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
