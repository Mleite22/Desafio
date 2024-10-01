<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       if(!User::where('email', 'admin@admin.com.br')->first()){
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com.br',
            'password' => Hash::make('12345678', ['rounds' => 12]),
        ]);
       }

       if(!User::where('email', 'heloisa@doublesp.com.br')->first()){
        User::create([
            'name' => 'Heloisa',
            'email' => 'heloisa@doublesp.com.br',
            'password' => Hash::make('12345678', ['rounds' => 12]),
        ]);
       }

       if(!User::where('email', 'aylacarlamoraes@oxiteno.com')->first()){
        User::create([
            'name' => 'Ayla',
            'email' => 'aylacarlamoraes@oxiteno.com',
            'password' => Hash::make('12345678', ['rounds' => 12]),
        ]);
       }

       if(!User::where('email', 'bernardo-barros72@newpark.com')->first()){
        User::create([
            'name' => 'Bernardo',
            'email' => 'bernardo-barros72@newpark.com',
            'password' => Hash::make('12345678', ['rounds' => 12]),
        ]);
       }
       if(!User::where('email', 'antonella_sandra_lima@virage.com.br')->first()){
        User::create([
            'name' => 'Antonella',
            'email' => 'antonella_sandra_lima@virage.com.br',
            'password' => Hash::make('12345678', ['rounds' => 12]),
        ]);
       }
    }
}
