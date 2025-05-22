<?php

namespace App\Http\Requests;

use App\Enums\OrderStatus;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class SaveOrderRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string'],
            'created_at'    => ['required', 'date'],
            'status'        => [
                Rule::when($this->isMethod(Request::METHOD_POST), [
                    'required'
                ]),
                Rule::enum(OrderStatus::class)
            ],
            'customer_note' => ['nullable', 'string'],
            'product_id'    => [
                Rule::when($this->isMethod(Request::METHOD_POST), [
                    'required',
                    Rule::exists(Product::class, 'id')
                ]),
            ],
        ];
    }
}
