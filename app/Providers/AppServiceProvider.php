<?php

namespace App\Providers;


use App\Classes\PersianNumbers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as RESPONSE_CODE;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('PersianNumbers', function () {
            return new PersianNumbers();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //
        Response::macro('common', [$this, 'common']);
        //
    }

    public function common($value = [])
    {
        $value['status'] = $this->translateStatus($value['status'] ?? 'success');
        $value['message'] = isset($value['message']) ? $value['message'] : __('Request processed successfully.');
        $value['data'] = isset($value['data']) ? $value['data'] : [];

        if (App::environment(['production'])) {
            unset($value['error_message']);
        }

        return Response::json($value)
            ->setStatusCode($value['status']);
    }

    private function translateStatus($status)
    {
        $statuses = [
            'success' => RESPONSE_CODE::HTTP_OK,
            'forbidden' => RESPONSE_CODE::HTTP_FORBIDDEN,
            'failed' => RESPONSE_CODE::HTTP_BAD_REQUEST,
        ];

        return $statuses[$status] ?? $status;
    }
}
