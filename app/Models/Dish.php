<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $category
 * @property string|null $description
 * @property int $is_vegetarian
 * @property int $is_vegan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Draft> $drafts
 * @property-read int|null $drafts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Menu> $menus
 * @property-read int|null $menus_count
 * @method static \Database\Factories\DishFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Dish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereIsVegan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereIsVegetarian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereUpdatedAt($value)
 * @mixin \Eloquent
 * @mixin IdeHelperDish
 */
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
