<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        User::create([
        'id' => '1',    
        'name' => 'Adm',
        'email' => 'adm@modelsell.com.br',
        'password' => Hash::make('admin'),
        'role' => 'admin'
        ]);
        User::create([
        'id' => '2',
        'name' => 'client1',
        'email' => 'client1@modelsell.com.br',
        'password' => Hash::make('client1'),
        'role' => 'client'
        ]);
        User::create([
        'id' => '3',
        'name' => 'client2',
        'email' => 'client2@modelsell.com.br',
        'password' => Hash::make('client2'),
        'role' => 'client'
        ]);
    
        User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('teste'),
        'role' => 'client'
        ]);
    }
}
