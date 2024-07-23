<?php

use App\Http\Controllers\TagihanController;
use App\Models\Customer;
use App\Models\Tagihan;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function(){
    Tagihan::create_tagihan();
})->everyMinute();

Schedule::call(function(){
    $customer = Customer::whereHas('cicilan', function ($query) {
        $query->where('status', "Belum Lunas");
    })->get();

    foreach ($customer as $item){
        Tagihan::send_monthly($item->no_hp, $item->nama);
    }
})->monthly(7, '06:00');

Schedule::call(function(){
    $customer = Customer::whereHas('cicilan', function ($query) {
        $query->where('status', "Belum Lunas");
    })->get();

    foreach ($customer as $item){
        Tagihan::send_deadline($item->no_hp, $item->nama);
    }
})->monthly(10, '06:00');

Schedule::call(function(){
    $customer = Customer::whereHas('cicilan', function ($query) {
        $query->where('status', "Belum Lunas");
    })->get();

    foreach ($customer as $item){
        Tagihan::send_monthly2($item->no_hp, $item->nama);
    }
})->monthly(3, '06:00');

Schedule::call(function(){
    $customer = Customer::whereHas('cicilan', function ($query) {
        $query->where('status', "Belum Lunas");
    })->get();

    foreach ($customer as $item){
        Tagihan::send_late($item->no_hp, $item->nama);
    }
})->monthly(11, '06:00');
