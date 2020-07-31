<?php

namespace App\Models;

use Auth;
use Laravel\Passport\HasApiTokens;
use App\Traits\PassportCustomization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\Relations\UserRelationTrait;
use App\Models\Interfaces\HasDefaultImageInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasDefaultImageInterface
{
    use UserRelationTrait, HasApiTokens, Notifiable, PassportCustomization;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password'];

    protected $appends = ['name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'email'];

    public function owns(Model $model, $strict = false): bool
    {
        $user = Auth::user();
        $admin = $user->is_admin && !$strict ?? false;

        return $admin || $this->id === $model->user_id;
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
