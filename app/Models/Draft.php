<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property string|null $price
 * @property string|null $duration
 * @property string|null $image
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $photo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dish> $dishes
 * @property-read int|null $dishes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Draft newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Draft newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Draft query()
 * @method static \Illuminate\Database\Eloquent\Builder|Draft whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Draft whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Draft whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Draft whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Draft whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Draft whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Draft wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Draft wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Draft whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Draft whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Draft whereUserId($value)
 * @mixin \Eloquent
 * @mixin IdeHelperDraft
 */
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