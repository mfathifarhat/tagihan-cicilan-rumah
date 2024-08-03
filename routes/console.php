<?php

use App\Http\Controllers\TagihanController;
use App\Models\Cicilan;
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
    $customer = Cicilan::whereHas('tagihan', function ($query) {
        $query->where('status', "Belum Lunas");
    })->get();

    foreach ($customer as $item){
        Tagihan::send_monthly($item->customer->no_hp, $item->customer->nama);
    }
})->monthlyOn(7);

// Schedule::call(function(){
//     $customer = Cicilan::whereHas('tagihan', function ($query) {
//         $query->where('status', "Belum Lunas");
//     })->get();

//     foreach ($customer as $item){
//         Tagihan::send_deadline($item->customer->no_hp, $item->customer->nama);
//     }
// })->monthly(10);

Schedule::call(function(){
    $customer = Cicilan::whereHas('tagihan', function ($query) {
        $query->where('status', "Belum Lunas");
    })->get();

    foreach ($customer as $item){
        Tagihan::send_monthly2($item->customer->no_hp, $item->customer->nama);
    }
})->monthlyOn(3);

Schedule::call(function(){
    $customer = Cicilan::whereHas('tagihan', function ($query) {
        $query->where('status', "Belum Lunas");
    })->get();

    foreach ($customer as $item){
        Tagihan::send_late($item->customer->no_hp, $item->customer->nama);
    }
})->monthlyOn(11);

