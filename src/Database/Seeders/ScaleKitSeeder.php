<?php

namespace AaqibShahzad\ScaleKit\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class ScaleKitSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);

        if (!User::where('email', 'admin@example.com')->exists()) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
            $admin->assignRole('admin');
        }
    }
}