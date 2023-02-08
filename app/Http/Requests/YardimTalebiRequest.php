<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YardimTalebiRequest extends FormRequest
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
            'tel' => 'required',
            'ihtiyac_turu' => 'required',
            'kac_kisilik' => 'required',
            'sehir' => 'required',
            'ilce' => 'required',
            'mahalle' => 'required',
        ];
    }
}
