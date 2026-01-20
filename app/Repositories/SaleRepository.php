<?php
namespace App\Repositories;

use App\Models\Sale;

class SaleRepository
{
    public function getAll()
    {
        return Sale::with('car')->get();
    }

    public function create(array $data)
    {
        return Sale::create($data);
    }

    public function findById($id)
    {
        return Sale::find($id);
    }
    
    public function existsSaleForCar($carId)
    {
        return Sale::where('car_id', $carId)->exists();
    }

    public function update(Sale $sale, array $data)
    {
        $sale->update($data);
        return $sale;
    }
}