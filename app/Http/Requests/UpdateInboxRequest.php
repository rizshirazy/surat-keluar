<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateInboxRequest extends FormRequest
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
            'origin'        => 'required',
            'reff'          => 'required',
            'category_id'   => 'required|exists:categories,id',
            'type_id'       => 'required|exists:types,id',
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
            'reff.required'         => 'Nomor Surat tidak boleh kosong',
            'origin.required'       => 'Asal Surat tidak boleh kosong',
            'category_id.required'  => 'Kode Surat tidak boleh kosong',
            'type_id.required'      => 'Sifat Surat tidak boleh kosong',
            'date.required'         => 'Tanggal Surat tidak boleh kosong',
            'date.date'             => 'Format Tanggal tidak sesuai',
            'subject.required'      => 'Perihal tidak boleh kosong',
        ];
    }
}
