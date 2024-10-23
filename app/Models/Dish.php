<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'is_vegetarian',
        'is_vegan',
        // Autres colonnes que tu veux permettre
    ];

    // Définir la relation Many-to-Many avec les menus
    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }
    public function drafts()
    {
        return $this->belongsToMany(Draft::class, 'draft_dish', 'dish_id', 'draft_id');
    }
}
