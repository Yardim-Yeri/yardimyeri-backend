<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HelpStartRequest extends FormRequest
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
        $rules = [
            'status' => 'required'
        ];

        if ($this->status == 'Yardım Geliyor') {
            $rules['name'] = 'required';
            $rules['tel'] = 'required';
        }

        return $rules;
    }
}
