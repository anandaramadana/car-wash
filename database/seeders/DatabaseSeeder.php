<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([[
            "nama"  => "admin",
            "nohp" => "081122223333",
            "email" => "admin@gmail.com",
            "password" => Hash::make("12345"),
            "role" => "admin",
        ], [
            "nama"  => "member",
            "nohp" => "082244446666",
            "email" => "member@gmail.com",
            "password" => Hash::make("12345"),
            "role" => "member",
        ]]);

        DB::table('cars')->insert([[
            "user_id" => 2,
            "merk" => "Toyota",
            "model" => "Avanza",
            "plat_no" => "B 1155 AA"
        ]]);

        DB::table('services')->insert([[
            "jenis" => "Washing",
            "gambar" => "washing.jpg",
            "desc" => "Mencuci Mobil",
            "harga" => 500000
        ],[
            "jenis" => "Detailing",
            "gambar" => "detailing.jpg",
            "desc" => "Detailing Mobil",
            "harga" => 1000000
        ],[
            "jenis" => "Wrapping",
            "gambar" => "wrapping.jpg",
            "desc" => "Wrapping Mobil",
            "harga" => 1500000
        ]]);
    }
}
