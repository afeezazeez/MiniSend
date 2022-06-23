<?php

namespace App\Http\Controllers\Api;

use App\Models\Email;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseStructure;
use App\Http\Requests\SendEmailRequest;

class EmailController extends Controller
{
    use ApiResponseStructure;

    // get all emails
    public function store(SendEmailRequest $request)
    {
        // store the email database
       $email =  Email::create($request->validated());

        //send email through background job
        if($email){
            SendEmailJob::dispatch($email);
        }


        return $this->success(null,'Email sent successfully',Response::HTTP_CREATED);

    }
}
