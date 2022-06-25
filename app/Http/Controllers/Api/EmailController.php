<?php

namespace App\Http\Controllers\Api;

use App\Models\Email;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Response;
use App\Services\EmailService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Traits\ApiResponseStructure;
use App\Http\Resources\EmailResource;
use App\Http\Requests\SendEmailRequest;
use App\Http\Resources\EmailShowResource;
use App\Http\Resources\EmailResourceCollection;

class EmailController extends Controller
{
    use ApiResponseStructure;

    public $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;

    }


    // analytics
    public function analytics()
    {
        $emails = DB::table('emails')->select('status')->get();

       // return $emails;
        $analytics = [
            'total_emails'=>$emails->count(),
            'total_sent'=>$emails->where('status',Email::EMAIL_SENT_STATUS)->count(),
            'total_posted'=>$emails->where('status',Email::EMAIL_POSTED_STATUS)->count(),
            'total_failed'=>$emails->where('status',Email::EMAIL_FAILED_STATUS)->count()
        ];

        return $this->success($analytics,null,Response::HTTP_OK);
    }


    // get all emails
    public function index()
    {
        $emails = Email::orderBy('created_at','desc')->paginate(10);
        return EmailResource::collection($emails);

    }

    // create and send email
    public function store(SendEmailRequest $request)
    {
        $email = $this->emailService->createAndSendEmail($request);

        //send email through background job
        if($email){
            //SendEmailJob::dispatch($email);
        }

        return $this->success(null,'Email sent successfully',Response::HTTP_CREATED);

    }

    public function show(Email $email)
    {
        return EmailShowResource::make($email);
    }


    public function searchEmails(SearchRequest $request)
    {
        $emails = $this->emailService->applyFilter();

        return EmailResource::collection($emails);
    }


    public function fetchRecipientEmails($email)
    {
        $emails = Email::where('to_email',$email)->orderBy('created_at','desc')->paginate(10);
        if(!count($emails)){
            return $this->error('Recipient email not found',Response::HTTP_NOT_FOUND,null);
        }

        return EmailResource::collection($emails);
    }


    public function searchRecipientEmails(SearchRequest $request,$email)
    {
        $recipientEmails = $this->emailService->applyFilter($email);
        return EmailResource::collection($recipientEmails);
    }


}
