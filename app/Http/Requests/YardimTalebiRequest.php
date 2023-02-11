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
            'phone_number' => 'required',
            'need_type' => 'required',
            'how_many_person' => 'required',
            'province' => 'required',
            'district_id' => 'required',
            'neighborhood_id' => 'required',
        ];
    }
}
