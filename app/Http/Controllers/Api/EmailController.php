<?php

namespace App\Http\Controllers\Api;

use App\Models\Email;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Response;
use App\Services\EmailService;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseStructure;
use App\Http\Resources\EmailResource;
use App\Http\Requests\SendEmailRequest;
use App\Http\Resources\EmailShowResource;

class EmailController extends Controller
{
    use ApiResponseStructure;

    public $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;

    }

    // get all emails
    public function index()
    {
        $emails = EmailResource::collection(Email::orderBy('created_at','desc')->paginate(10));
        return $this->success($emails,null,Response::HTTP_OK);
    }

    // create and send email
    public function store(SendEmailRequest $request)
    {

        $email = $this->emailService->createAndSendEmail($request);


        //send email through background job
        if($email){
            SendEmailJob::dispatch($email);
        }


        return $this->success(null,'Email sent successfully',Response::HTTP_CREATED);

    }

    public function show(Email $email)
    {
        return EmailShowResource::make($email);
    }
}
