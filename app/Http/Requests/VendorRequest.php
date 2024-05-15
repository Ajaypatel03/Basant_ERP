<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
             'v_name' => 'required|string|max:255',
             'v_mobile' => 'required|string|max:10',
             'v_address' => 'required|string|max:255',
             'v_bank_name' => 'required|string|max:255',
             'v_bank_acc_no' => 'required|string|max:255',
             'v_ifsc' => 'required|string|max:255',
             'v_bank_location' => 'required|string|max:255',
        ];
    }
}