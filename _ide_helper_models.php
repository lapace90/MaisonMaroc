<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property string $duration
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperActivity {}
}

namespace App\Models{
/**
 * 
 *
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
 */
	#[\AllowDynamicProperties]
	class IdeHelperDish {}
}

namespace App\Models{
/**
 * 
 *
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
 */
	#[\AllowDynamicProperties]
	class IdeHelperDraft {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $price
 * @property int $user_id
 * @property string|null $photo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dish> $dishes
 * @property-read int|null $dishes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperMenu {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $customer_name
 * @property string $reservation_date
 * @property int $number_of_people
 * @property string $amount
 * @property string $payment_status
 * @property int $invoice_sent
 * @property string|null $payment_date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $customer_email
 * @property string $check_in_date
 * @property string $check_out_date
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Menu> $menus
 * @property-read int|null $menus_count
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCheckInDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCheckOutDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereInvoiceSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereNumberOfPeople($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereReservationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperReservation {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property int $is_admin
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

