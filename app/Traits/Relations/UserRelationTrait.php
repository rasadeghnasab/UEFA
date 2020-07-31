<?php

namespace App\Traits\Relations;

use App\Models\Event;
use App\Models\Address;
use App\Models\Athlete;
use App\Models\Instagram;
use App\Models\BankAccount;
use App\Models\TransactionUser;
use App\Models\Province as City;

trait UserRelationTrait
{
    public function athletes()
    {
        return $this->hasMany(Athlete::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function bank()
    {
        return $this->hasOne(BankAccount::class)->withDefault();
    }

    public function instagram()
    {
        return $this->hasOne(Instagram::class, 'user_id', 'id');
    }

    public function ownedAddresses()
    {
        return $this->hasMany(Address::class);
    }

    public function transaction()
    {
        return $this->hasMany(TransactionUser::class);
    }
}
