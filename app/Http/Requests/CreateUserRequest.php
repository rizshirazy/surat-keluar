<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends FormRequest
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
            'name'              => 'required',
            'email'             => 'required|unique:users,email|email',
            'nip'               => 'required|unique:users,nip',
            'position'          => 'required',
            'is_active'         => 'required|in:Y,N',
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
            'name.required'             => 'Nama Pengguna tidak boleh kosong',
            'email.required'            => 'Email tidak boleh kosong',
            'email.unique'              => 'Email sudah digunakan',
            'nip.required'              => 'NIP tidak boleh kosong',
            'nip.unique'                => 'NIP sudah digunakan',
            'position.required'         => 'Jabatan tidak boleh kosong',
            'password.required'         => 'Password tidak boleh kosong',
            'password.min'              => 'Password minimum :min karakter',
            'password_confirm.required' => 'Konfirmasi password tidak boleh kosong',
            'password_confirm.same'     => 'Konfirmasi password tidak sama',
        ];
    }
}
