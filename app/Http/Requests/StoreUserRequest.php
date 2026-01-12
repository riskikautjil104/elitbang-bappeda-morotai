<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'nama_opd' => 'required|string|max:255',
            'role' => 'required|in:superadmin,opd',
            'opd_id' => 'nullable|exists:opds,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role tidak valid.',
            'opd_id.exists' => 'OPD yang dipilih tidak valid.',
            'nama_opd.required' => 'Nama OPD wajib diisi.',
            'nama_opd.string' => 'Nama OPD harus berupa teks.',
            'nama_opd.max' => 'Nama OPD maksimal 255 karakter.',
        ];
    }
}
