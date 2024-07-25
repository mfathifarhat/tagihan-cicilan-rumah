<?php

namespace Database\Seeders;

use App\Models\Rumah;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(100)->create();

        User::factory()->create([
            'name' => 'Muhammad Fathi Farhat',
            'kode_admin'=>'ADM001',
            'email' => 'admin@gmail.com',
            'password' => 'trisa7878',
        ]);

        // $faker = Faker::create('id_ID');
        // for ($i = 0; $i < 50; $i++) {
        //     Rumah::create([
        //         'alamat' => $faker->address(),
        //         'luas_tanah' => $faker->numberBetween(60, 200),
        //         'luas_bangunan' => $faker->numberBetween(60, 200),
        //         'jumlah_kamar' => $faker->numberBetween(2, 6),
        //         'harga' => $faker->numberBetween(500000000, 99999999999),
        //         'status' => $faker->realTextBetween()
        //     ]);
        // }
    }
}
