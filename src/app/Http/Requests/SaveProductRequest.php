<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveProductRequest extends FormRequest
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
        return [
            'category_id' => [
                'required',
                Rule::exists(Category::class, 'id'),
            ],
            'name' => 'required',
            'price' => 'required|decimal:0,2',
            'description' => 'required',
        ];
    }

    public function data() {
        $result = $this->validated();
        $result['price'] = $result['price'] * 100;
        return $result;
    }
}
