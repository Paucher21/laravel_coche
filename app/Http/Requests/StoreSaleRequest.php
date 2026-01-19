<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric',
            'sale_date' => 'required|date', // Nota: camelCase en JSON -> snake_case en DB
            'seller_id' => 'required|exists:users,id', // Asumiendo tabla users, o solo integer
            'client_id' => 'required|integer',
            'car_id' => 'required|exists:cars,id',
        ];
    }

    protected function prepareForValidation(){
        if($this->saleDate) $this->merge(['sale_date' => $this->saleDate]);
        if($this->sellerId) $this->merge(['seller_id' => $this->sellerId]);
        if($this->clientId) $this->merge(['client_id' => $this->clientId]);
        if($this->carId)    $this->merge(['car_id' => $this->carId]);
    }
}
