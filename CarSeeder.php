<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the existing branches (or create them if they don't exist)
        $branches = [
            'Bandar Baru Bangi' => 'ECE Headquarters',
            'Shah Alam' => 'ECE Branch',
            'Gombak' => 'ECE Branch'
        ];
        
        $branchIds = [];
        
        // Ensure branches exist
        foreach ($branches as $location => $name) {
            $branch = Branch::where('location', $location)->first();
            
            if (!$branch) {
                $branch = Branch::create([
                    'name' => $name,
                    'location' => $location,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
            $branchIds[$location] = $branch->id;
        }
        
        // Define car data for each branch
        $carTypes = ['sedan', 'SUV', 'hatchback', 'MPV', 'pickup'];
        $transmissions = ['automatic', 'manual'];
        $colors = ['white', 'black', 'silver', 'red', 'blue', 'gray'];
        
        // Create cars for each branch
        foreach ($branchIds as $location => $branchId) {
            // Create 5 cars for each branch
            for ($i = 1; $i <= 5; $i++) {
                $brand = $this->getRandomBrand();
                $model = $this->getModelForBrand($brand);
                
                Car::create([
                    'brand' => $brand,
                    'model' => $model,
                    'type' => $carTypes[array_rand($carTypes)],
                    'transmission' => $transmissions[array_rand($transmissions)],
                    'color' => $colors[array_rand($colors)],
                    'year' => rand(2020, 2025),
                    'plate_number' => 'ECE' . $branchId . rand(1000, 9999),
                    'daily_rate' => rand(100, 300),
                    'description' => "A reliable $brand $model for your journey.",
                    'available' => true,
                    'branch_id' => $branchId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        
        $this->command->info('Created ' . (5 * count($branchIds)) . ' cars across ' . count($branchIds) . ' branches.');
    }
    
    /**
     * Get a random car brand
     */
    private function getRandomBrand(): string
    {
        $brands = [
            'Toyota', 'Honda', 'Proton', 'Perodua', 
            'Nissan', 'Mazda', 'Hyundai', 'Kia'
        ];
        
        return $brands[array_rand($brands)];
    }
    
    /**
     * Get a model based on the car brand
     */
    private function getModelForBrand(string $brand): string
    {
        $models = [
            'Toyota' => ['Vios', 'Camry', 'Corolla', 'Innova', 'Fortuner'],
            'Honda' => ['City', 'Civic', 'Accord', 'HR-V', 'CR-V'],
            'Proton' => ['Saga', 'Persona', 'X50', 'X70', 'Iriz'],
            'Perodua' => ['Myvi', 'Axia', 'Bezza', 'Aruz', 'Ativa'],
            'Nissan' => ['Almera', 'X-Trail', 'Serena', 'Leaf', 'Navara'],
            'Mazda' => ['Mazda2', 'Mazda3', 'CX-3', 'CX-5', 'CX-8'],
            'Hyundai' => ['Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'Kona'],
            'Kia' => ['Cerato', 'Optima', 'Sportage', 'Sorento', 'Seltos']
        ];
        
        $brandModels = $models[$brand] ?? ['Model' . rand(1, 5)];
        return $brandModels[array_rand($brandModels)];
    }
}