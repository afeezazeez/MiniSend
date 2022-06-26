<?php

namespace App\Http\Controllers\Api;

use App\Models\Email;
use App\Helpers\Logger;
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

        $result = DB::select("SELECT
                    COUNT(*) as totalCount,
                    COUNT(IF(`status` = 'Posted', 1, NULL)) as postedCount,
                    COUNT(IF(`status` = 'Sent', 1, NULL)) as sentCount,
                    COUNT(IF(`status` = 'Failed', 1, NULL)) as failedCount
                    FROM emails");

        $analytics = [
            'total_emails'=> $result[0]->totalCount,
            'total_sent'=>$result[0]->sentCount,
            'total_posted'=>$result[0]->postedCount,
            'total_failed'=>$result[0]->failedCount
        ];

        return $this->success($analytics,null,Response::HTTP_OK);


    }


    // get all emails
    public function index()
    {


        $emails = DB::table('emails')->select('id','from_email','to_email','subject','status','created_at')
        ->orderBy('created_at','desc')
        ->paginate(10);
        return $emails;

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


    public function searchEmails(SearchRequest $request)
    {

        $emails = $this->emailService->applyFilter();

       return $emails;
    }


    public function fetchRecipientEmails($email)
    {
        $emails =DB::table('emails')->where('to_email',$email)->orderBy('created_at','desc')->paginate(10);
        if(!$emails->total()){
            return $this->error('Recipient email not found',Response::HTTP_NOT_FOUND,null);
        }

        return $emails;
    }


    public function searchRecipientEmails(SearchRequest $request,$email)
    {

        $recipientEmails = $this->emailService->applyFilter($email);
        return $recipientEmails;
    }


}
