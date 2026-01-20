<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Sale;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $car1 = Car::create(['license' => '1111AAA', 'model' => 'Fiesta', 'brand' => 'Ford', 'used' => true]);
        $car2 = Car::create(['license' => '2222BBB', 'model' => 'Clio', 'brand' => 'Renault', 'used' => false]);
        $car3 = Car::create(['license' => '3333CCC', 'model' => 'Ibiza', 'brand' => 'Seat', 'used' => true]);
       
        Car::create(['license' => '4444DDD', 'model' => 'Civic', 'brand' => 'Honda', 'used' => false]);

       
        Sale::create([
            'status' => 'Created', 'amount' => 5000, 'sale_date' => '2024-01-01', 
            'seller_id' => 1, 'client_id' => 10, 'car_id' => $car1->id
        ]);

        Sale::create([
            'status' => 'Paid', 'amount' => 12000, 'sale_date' => '2024-02-01', 
            'seller_id' => 2, 'client_id' => 11, 'car_id' => $car2->id
        ]);
        
        Sale::create([
            'status' => 'Cancelled', 'amount' => 3000, 'sale_date' => '2024-03-01', 
            'seller_id' => 1, 'client_id' => 12, 'car_id' => $car3->id
        ]);
    }
}
