<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && role('SUPER ADMIN');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code'              => 'required|unique:categories,code',
            'name'              => 'required',
            'description'       => 'required',
            'group_category_id' => 'required|exists:group_categories,id',
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
            'code.required'                 => 'Klasifikasi Surat tidak boleh kosong',
            'code.unique'                   => 'Klasifikasi Surat ini sudah digunakan',
            'name.required'                 => 'Keterangan tidak boleh kosong',
            'description.required'          => 'Deskripsi tidak boleh kosong. Isi dengan tanda "-" jika tidak ada deskripsi',
            'group_category_id.required'    => 'Kelompok Surat tidak boleh kosong',
            'group_category_id.exists'      => 'Kelompok Surat tidak tersedia',
        ];
    }
}
