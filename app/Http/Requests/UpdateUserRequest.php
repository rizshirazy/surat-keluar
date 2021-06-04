<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');

        return [
            'name'              => 'required',
            'email'             => 'required|unique:users,email,' . $user->id . '|email',
            'nip'               => 'required|unique:users,nip,' . $user->id,
            'position'          => 'required',
            'is_active'         => 'required|in:Y,N',
            'role_id'           => 'required|exists:user_roles,id',
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
            'role_id.required'          => 'Role Pengguna tidak boleh kosong',
        ];
    }
}
