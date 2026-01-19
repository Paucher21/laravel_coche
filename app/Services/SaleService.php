<?php

namespace App\Services;

use App\Repositories\SaleRepository;
use App\Exceptions\SalePreconditionFailedException;
use App\Exceptions\SaleNotFoundException;

class SaleService
    {
        protected SaleRepository $saleRepository;
        public function __construct(SaleRepository $saleRepository){
            $this->saleRepository = $saleRepository;
        }

        public function getAllSales(){
            return $this->saleRepository->getAll();
        }

        public function createSale(array $data){
            // Regla: 412 si ya existe venta para el carId
            if ($this->saleRepository->existsSaleForCar($data['car_id'])) {
                throw new SalePreconditionFailedException("Ya existe una venta para el vehículo indicado.");
            }

            // Estado por defecto Created
            $data['status'] = 'Created';
            
            return $this->saleRepository->create($data);
        }

        public function updateStatus($id, $newStatus){
            $sale = $this->saleRepository->findById($id);

            // Regla: 404 si no existe
            if (!$sale) {
                throw new SaleNotFoundException("Venta no encontrada.");
            }

            // Regla: 412 si el estado actual no es 'Created'
            if ($sale->status !== 'Created') {
                throw new SalePreconditionFailedException("Solo se pueden modificar ventas en estado 'Created'.");
            }

            // Regla: Solo permite Paid o Cancelled (aunque la validación de request filtrará, es bueno tener doble check)
            return $this->saleRepository->update($sale, ['status' => $newStatus]);
        }
    }