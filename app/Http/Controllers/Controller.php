<?php

namespace App\Http\Controllers;

use App\Services\SaleService;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleStatusRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class SaleController extends Controller
{
    protected $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    public function index(): JsonResponse
    {
        $sales = $this->saleService->getAllSales();
        return response()->json($sales, 200);
    }

    public function store(StoreSaleRequest $request): JsonResponse
    {
        $sale = $this->saleService->createSale($request->all());
        return response()->json($sale, 201);
    }

    public function updateStatus(UpdateSaleStatusRequest $request, $id): JsonResponse
    {
        $sale = $this->saleService->updateStatus($id, $request->status);
        return response()->json($sale, 200);
    }
}
