<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use App\Traits\HasAddress;
use App\Traits\ImageableTrait;
use Laravel\Passport\HasApiTokens;
use App\Traits\PassportCustomization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\Relations\UserRelationTrait;
use App\Traits\Cache\AddressableCacheTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Interfaces\AddressableInterface;
use App\Traits\Images\UserNationalCardImageTrait;
use App\Models\Interfaces\HasDefaultImageInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasDefaultImageInterface, AddressableInterface
{
    use UserRelationTrait, AddressableCacheTrait;
    use ImageableTrait, UserNationalCardImageTrait;
    use HasApiTokens, HasAddress, Notifiable, PassportCustomization;

    protected $passportUsername = 'mobile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'mobile', 'city_id', 'gender', 'weight', 'height', 'national_code', 'birthdate'];

    protected $appends = ['role_name', 'name'];

    protected $dates = [
        'birthdate',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'role', 'role_id', 'email'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate'         => 'datetime',
    ];

    public function owns(Model $model, $strict = false): bool
    {
        $user = Auth::user();
        $admin = $user->is_admin && !$strict ?? false;

        return $admin || $this->id === $model->user_id;
    }

    public function getIsAdminAttribute()
    {
        // Todo: This should be check.
        return $this->hasRole('admin');
    }

    public function getRoleNameAttribute()
    {
        // Todo: This should be fix.
        return 'Todo:: this should be fix';
        return $this->role->name;
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function scopeFindByMobile($query, $mobile)
    {
        return $query->where('mobile', '=', $mobile);
    }

    /**
     * Set the user's birthdate.
     *
     * @param  string  $value
     * @return void
     */
    public function setBirthdateAttribute($value)
    {
        // Todo: this should be change.
        $birthdate_timestamp = date("Y-m-d h:i:s", strtotime('-5 years'));
        $this->attributes['birthdate'] = $birthdate_timestamp;
    }

    /**
     * Calcualge the user age on a specific date.
     */
    public function ageOnADate($date)
    {
        if (is_null($birthdate = $this->attributes['birthdate'])) {
            return 0;
        }

        return Carbon::parse($birthdate)->diffInYears(Carbon::parse($date));
    }

    public function getAgeAttribute($value)
    {
        return $this->ageOnADate('now');
    }

    public function getWeightAttribute($value)
    {
        return $value ?? 0;
    }

    public function getHeightAttribute($value)
    {
        return $value ?? 0;
    }

    public function getGenderAttribute($value)
    {
        return $value ?? '';
    }

    public function getSportsAttribute()
    {
        return $this->athletes()->pluck('sport_id');
    }

    /**
     * Route notifications for the SMS channel.
     *
     * @param  \Illuminate\Notifications\Notification $notification
     * @return string
     */
    public function routeNotificationForSms($notification)
    {
        return $this->mobile;
    }
}
