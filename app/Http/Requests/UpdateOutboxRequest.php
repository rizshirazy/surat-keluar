<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateOutboxRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'destination'   => 'required',
            'category_id'   => 'required|exists:categories,id',
            'date'          => 'required|date',
            'subject'       => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'destination.required'      => 'Tujuan Surat tidak boleh kosong',
            'category_id.required'      => 'Kode Surat tidak boleh kosong',
            'date.required'             => 'Tanggal Surat tidak boleh kosong',
            'date.date'                 => 'Format Tanggal tidak sesuai',
            'subject.required'          => 'Perihal tidak boleh kosong',
        ];
    }
}
