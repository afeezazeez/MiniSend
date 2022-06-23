<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

use Illuminate\Contracts\Validation\Validator;



class SendEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'from_email' => 'required',
            'to_email' => 'required|different:from_email',
            'subject' => 'required',
            'text_content' => 'required',
            'html_content' => 'nullable',
            'attachments' =>'nullable'

        ];
    }

    protected function failedValidation(Validator $validator) {

        throw new HttpResponseException(response([
            'status' => 'error',
            'message' =>null,
            'data'=>$validator->errors()
        ],Response::HTTP_BAD_REQUEST));
    }
}
