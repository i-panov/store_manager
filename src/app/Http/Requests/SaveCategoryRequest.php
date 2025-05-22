<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveCategoryRequest extends FormRequest
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
        if (request()->routeIs('categories.create')) {
            return [
                'create_name' => [
                    'required',
                    Rule::unique(Category::class, 'name'),
                ],
            ];
        }

        if (request()->routeIs('categories.update')) {
            return [
                'update_name.*' => [
                    'required',
                    Rule::unique(Category::class, 'name')->ignore(request()->id),
                ],
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            'create_name.required' => 'Введите название категории.',
            'create_name.unique' => 'Категория с таким названием уже существует.',
            'update_name.*.required' => 'Введите название категории.',
            'update_name.*.unique' => 'Категория с таким названием уже существует.',
        ];
    }
}
