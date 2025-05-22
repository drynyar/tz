<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Symfony\Component\HttpFoundation\Request;

class SaveProductRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'        => [
                'required', 'string',
                Rule::unique('products')->when(
                    $this->isMethod(Request::METHOD_PUT),
                    fn(Unique $rule) => $rule->ignore($this->product->id),
                )
            ],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric'],
            'category_id' => ['required', Rule::exists(Category::class, 'id')],
        ];
    }
}
