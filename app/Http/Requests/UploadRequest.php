<?php

namespace App\Http\Requests;

use App\Rules\MaxSizeUploadFile;
use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => [
                'required',
                'file',
                'mimetypes:application/excel,application/vnd.ms-excel,application/vnd.msexcel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'mimes:xlsx',
                new MaxSizeUploadFile()
            ]
        ];
    }
}
