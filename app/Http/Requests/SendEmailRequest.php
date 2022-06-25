<?php

namespace App\Http\Requests;

use App\Models\Email;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;



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
            'subject' => 'required|max:225',
            'html_content' => 'required',
            'files'=>'nullable|array',
            'files.*' => 'required|mimes:png,jpg,jpeg,pdf,docx|max:20000',

        ];
    }


    public function messages()
    {
        return [
            'files.*.mimes' => 'Only jpeg, png, jpg,pdf,docx  are allowed',
            'files.*.max' => 'Sorry! Maximum allowed size file is 20MB',
            'html_content.required' => 'Email body is required',
        ];
    }



    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response([
            'status' => 'error',
            'message' =>null,
            'data'=>$validator->errors()
        ],Response::HTTP_BAD_REQUEST));
        //  throw new HttpResponseException(response()->json([
        //     'status' => 'error',
        //     'message' =>null,
        //     'data'=>$validator->errors()->all()],Response::HTTP_BAD_REQUEST
        // ));
    }





}
