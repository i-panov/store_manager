<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Product;

class SaveOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $request = request();

        if ($request->routeIs('orders.store')) {
            return [
                'product_id' => ['required', Rule::exists(Product::class, 'id')],
                'product_count' => ['required', 'integer', 'min:0'],
                'customer_name' => ['required', 'string'],
                'comment' => ['nullable', 'string'],
            ];
        }

        if ($request->routeIs('orders.update')) {
            return [
                'product_count' => ['required', 'integer', 'min:0'],
                'customer_name' => ['required', 'string'],
                'comment' => ['nullable', 'string'],
            ];
        }

        return [];
    }
}
