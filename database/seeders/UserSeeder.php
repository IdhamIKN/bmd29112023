<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'gender' => 'male',
            'active' => 1,
            'nohp' => '1234567890',
            'remember_token' => Str::random(10)
        ]);

        // $permissions = Permission::pluck('id','id')->all();
        // $role->syncPermissions($permissions);
        $superadmin->assignRole('superadmin');

        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'gender' => 'male',
            'active' => 1,
            'nohp' => '1234567890',
            'remember_token' => Str::random(10)
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'gender' => 'male',
            'active' => 1,
            'nohp' => '1234567890',
            'remember_token' => Str::random(10)
        ]);
        $user->assignRole('user');
        // User::factory()->count(9)->create()->each(function ($user) {
        //     $username = Str::random(8); // Generate a random username
        //     $nohp = '08' . rand(100000000, 999999999); // Generate a random 10-digit phone number

        //     // Ensure that the generated username and phone number are unique
        //     while (User::where('username', $username)->exists() || User::where('nohp', $nohp)->exists()) {
        //         $username = Str::random(8); // Regenerate the username if it's not unique
        //         $nohp = '08' . rand(100000000, 999999999); // Regenerate the phone number if it's not unique
        //     }

        //     $user->update([
        //         'username' => $username,
        //         'nohp' => $nohp,
        //     ]);

        //     $user->assignRole('user');
        // });


    }

}
