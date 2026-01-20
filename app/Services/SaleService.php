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
           
            if ($this->saleRepository->existsSaleForCar($data['car_id'])) {
                throw new SalePreconditionFailedException("Ya existe una venta para el vehículo indicado.");
            }

            
            $data['status'] = 'Created';
            
            return $this->saleRepository->create($data);
        }

        public function updateStatus($id, $newStatus){
            $sale = $this->saleRepository->findById($id);

            if (!$sale) {
                throw new SaleNotFoundException("Venta no encontrada.");
            }
            
            if ($sale->status !== 'Created') {
                throw new SalePreconditionFailedException("Solo se pueden modificar ventas en estado 'Created'.");
            }

            return $this->saleRepository->update($sale, ['status' => $newStatus]);
        }
    }