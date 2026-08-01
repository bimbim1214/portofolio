<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin user
        User::updateOrCreate(
            ['name' => 'bimogacor'], // We use 'name' as username
            [
                'email' => 'admin@admin.com',
                'password' => bcrypt('bimogacor14'),
            ]
        );

        $this->call([
            PortfolioSeeder::class,
        ]);
    }
}
