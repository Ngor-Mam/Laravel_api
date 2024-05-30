<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentRequest extends DefaultRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' =>'required',
            'age' =>'required|integer',
        ];
        if (filled(request()->route('id'))) {
            $rules['phone_number'] = 'required|unique:students,phone_number,' . request()->route('id') . ',id,deleted_at,NULL';
        } else { 
            $rules['phone_number'] = 'required|unique:students,phone_number,NULL,id,deleted_at,NULL';
        }
        return $rules;
    }
}
