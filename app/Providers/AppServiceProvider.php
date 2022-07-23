<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

use App\Model\Transaksi;
use App\Model\TransaksiDetail;
use App\Model\TransaksiPembayaran;
use App\Model\TransferGudang;

use App\Observers\TransaksiObserver;
use App\Observers\TransaksiDetailObserver;
use App\Observers\TransaksiPembayaranObserver;
use App\Observers\TransferGudangObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Transaksi::observe(TransaksiObserver::class);
        TransaksiDetail::observe(TransaksiDetailObserver::class);
        TransaksiPembayaran::observe(TransaksiPembayaranObserver::class);
        TransferGudang::observe(TransferGudangObserver::class);
        
        Validator::extend('greater_than_equal_to_field', function($attribute, $value, $parameters, $validator) {
            $min_field = $parameters[0];
            $data = $validator->getData();
            $min_value = $data[$min_field];
            return $value >= $min_value;
        });   

        Validator::replacer('greater_than_equal_to_field', function($message, $attribute, $rule, $parameters) {
            return str_replace(':field', $parameters[0], 'The '.str_replace('_',' ',$attribute). ' must greater than or equal to field '.str_replace('_',' ',$parameters[0]));
        });
    }
}
