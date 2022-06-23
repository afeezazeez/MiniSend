<?php

namespace App\Http\Controllers\Api;

use App\Models\Email;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\FileService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseStructure;
use App\Http\Requests\SendEmailRequest;

class EmailController extends Controller
{
    use ApiResponseStructure;

    // get all emails
    public function store(SendEmailRequest $request, FileService $fileService)
    {


        // store the email database
        $email =  Email::create(Arr::except($request->validated()  ,'files'));

        // upload email files
        if($request->files->all()){
           return $request->files;
            $fileService->uploadFiles($request->file);
        }

        //send email through background job
        if($email){
            //SendEmailJob::dispatch($email);
        }


        return $this->success(null,'Email sent successfully',Response::HTTP_CREATED);

    }
}
