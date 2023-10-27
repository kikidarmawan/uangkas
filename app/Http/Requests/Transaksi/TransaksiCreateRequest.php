<?php

namespace App\Http\Requests\Transaksi;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nominal' => 'required',
            'keterangan' => 'required|string',
            'jns_trx' => 'required|string|in:debit,kredit',
            'tanggal'  => 'required|date',
            'keterangan' => 'nullable|string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */

    public function messages(): array
    {
        return [
            'nominal.required' => 'Nominal tidak boleh kosong',
            'nominal.numeric' => 'Nominal harus berupa angka',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'jns_trx.required' => 'Jenis transaksi tidak boleh kosong',
            'jns_trx.in' => 'Jenis transaksi tidak valid',
            'date.required' => 'Tanggal tidak boleh kosong',
            'date.date' => 'Tanggal tidak valid',
            'keterangan.string' => 'Keterangan harus berupa string'
        ];
    }
}
