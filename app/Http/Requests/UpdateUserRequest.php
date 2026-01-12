<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:superadmin,opd',
            'nama_opd' => 'nullable|string|max:255',
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
            'password.min' => 'Password minimal 8 karakter.',
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role harus salah satu dari: admin, operator, viewer.',
            'opd_id.exists' => 'OPD yang dipilih tidak valid.',
            'nama_opd.string' => 'Nama OPD harus berupa teks.',
            'nama_opd.max' => 'Nama OPD maksimal 255 karakter.',
        ];
    }
}
