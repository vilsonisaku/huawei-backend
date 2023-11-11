<?php

namespace App\Http\Requests;


class CreateUserSensorRequest extends Request
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data'=>'required|array',
            'data.*.value'=>'required|array',
            'data.*.time'=>'required|date_format:Y-m-d H:i:s',
        ];
    }
}
