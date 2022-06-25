<?php

namespace App\Http\Requests;

use App\Models\Email;

use App\Models\Emails;

use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchRequest extends FormRequest
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
            'sender'=>'|nullable|string|max:225',
            'recipient'=>'nullable|string|max:225',
            'subject'=>'nullable|string|max:225',
            'status'=>['nullable',Rule::in([Email::EMAIL_SENT_STATUS,Email::EMAIL_FAILED_STATUS,Email::EMAIL_POSTED_STATUS])],
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'Invalid email status'
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
