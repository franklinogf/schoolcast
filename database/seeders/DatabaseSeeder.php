<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
        ]);

        $tenant = Tenant::create([
            'name' => 'Demo Tenant',
            'id' => 'demo',
        ]);

        $tenant->domains()->create([
            'domain' => $tenant->id,
        ]);
    }
}
