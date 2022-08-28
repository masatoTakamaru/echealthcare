<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'header' => ['nullable', 'max:255'],
            'name' => ['required', 'max:255'],
            'serial' => ['required', 'max:255'],
            'price' => ['required', 'digits_between:1,7'],
            'inventory' => ['required', 'digits_between:1,6'],
            'spec' => ['nullable', 'max:1000'],
            'cat_id' => 'required',
            'subcat_id' => 'required',
            'maker' => ['required', 'max:255'],
        ];
    }
}
