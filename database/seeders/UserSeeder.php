<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create a default admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create a default regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Create multiple admin users
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => "admin{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => $faker->boolean(90) ? now() : null, // 90% verified
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => now(),
            ]);
        }

        // Create multiple regular users
        for ($i = 1; $i <= 25; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => $faker->boolean(75) ? now() : null, // 75% verified
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }

        // Create some unverified users for testing
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => "unverified{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => null, // Explicitly unverified
                'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Users seeded successfully!');
        $this->command->info('Total users created: ' . User::count());
        $this->command->info('Admin users: ' . User::where('role', 'admin')->count());
        $this->command->info('Regular users: ' . User::where('role', 'user')->count());
        $this->command->info('');
        $this->command->info('Default credentials:');
        $this->command->info('Admin: admin@example.com / password');
        $this->command->info('User: user@example.com / password');
    }
}
