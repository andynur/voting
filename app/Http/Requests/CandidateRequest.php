<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'profile_image' => 'required|mimes:jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'profile_image.required' => 'Foto wajib diisi!',
            'profile_image.mimes' => 'Foto harus dalam bentuk .jpg / .png',
        ];
    }
}
