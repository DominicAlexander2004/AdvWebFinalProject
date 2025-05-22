<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@easycarenterprise.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        // Get branches
        $branches = Branch::all();
        
        // If branches exist, create a staff user for each branch
        if ($branches->count() > 0) {
            foreach ($branches as $index => $branch) {
                User::create([
                    'name' => 'Staff ' . $branch->location,
                    'email' => 'staff' . ($index + 1) . '@easycarenterprise.com',
                    'password' => Hash::make('password123'),
                    'role' => 'staff',
                    'branch_id' => $branch->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
            $this->command->info('Created ' . ($branches->count() + 1) . ' users: 1 admin and ' . $branches->count() . ' staff members.');
        } else {
            $this->command->info('Created admin user. No branches found to create staff users.');
        }
    }
}