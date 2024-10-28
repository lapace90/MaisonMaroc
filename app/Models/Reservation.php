<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
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
 * @mixin IdeHelperReservation
 */
class Reservation extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_name',
        'reservation_date',
        'check_in_date',
        'check_out_date',
        'number_of_adults',
        'number_of_children',
        'amount',
        'payment_status',
        'invoice_sent',
        'reservation_menu',
        'reservation_activity',
        'room_type_id',
        'customer_email',
        'notes',
    ];
    /**
     * The menus that belong to the reservation.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'reservation_menu')->withPivot('quantity');
    }
    /**
     * The activities that belong to the reservation.
     */
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'reservation_activity')->withPivot('quantity');
    }
    /**
     * The room type that belong to the reservation.
     */
    public function rooms()
    {
        return $this->belongsToMany(RoomType::class, 'reservation_room');
    }
}
