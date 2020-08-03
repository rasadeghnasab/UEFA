<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Wallet;
use App\Models\Purchase;
use App\Models\TransactionUser;
use App\Models\PurchasePayment;
use App\Models\WithdrawRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class MorphMapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'shop' => Shop::class,
            'purchase' => Purchase::class,
            'user' => User::class,
            'withdrawRequest' => WithdrawRequest::class,
            'purchasePayment' => PurchasePayment::class,
            'wallet' => Wallet::class,
            'charge' => TransactionUser::class,
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
