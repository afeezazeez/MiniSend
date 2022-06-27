<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\IEmailService;
use App\Models\Email;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Traits\ApiResponseStructure;
use App\Http\Requests\SendEmailRequest;
use App\Http\Resources\EmailShowResource;

class EmailController extends Controller
{
    use ApiResponseStructure;

    private $emailService;

    public function __construct(IEmailService $emailService)
    {
        $this->emailService = $emailService;

    }


    /**
     * get email activities analytics
     *
     * @return object
     */
    public function analytics(): object
    {

        $result = DB::select("SELECT
                    COUNT(*) as totalCount,
                    COUNT(IF(`status` = 'Posted', 1, NULL)) as postedCount,
                    COUNT(IF(`status` = 'Sent', 1, NULL)) as sentCount,
                    COUNT(IF(`status` = 'Failed', 1, NULL)) as failedCount
                    FROM emails");

        $analytics = [
            'total_emails' => $result[0]->totalCount,
            'total_sent' => $result[0]->sentCount,
            'total_posted' => $result[0]->postedCount,
            'total_failed' => $result[0]->failedCount
        ];

        return $this->success($analytics, null, Response::HTTP_OK);


    }


    /**
     * fetch all emails.
     *
     * @return object
     */
    public function index(): object
    {
        $emails = DB::table('emails')->select('id', 'from_email', 'to_email', 'subject', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return $emails;

    }


    /**
     * Store and send  new email.
     * @param SendEmailRequest $request
     * @return object
     */
    public function store(SendEmailRequest $request): object
    {
        $email = $this->emailService->createAndSendEmail($request);

        //dispatch background job to send email
        if ($email) {
            SendEmailJob::dispatch($email);
        }

        return $this->success(null, 'Email sent successfully', Response::HTTP_CREATED);

    }

    /**
     * fetch a specified email.
     *
     * @param int $id
     * @return object
     */
    public function show(Email $email): object
    {
        return EmailShowResource::make($email);
    }

    /**
     * search and fetch emails based on filter.
     * @param SearchRequest $request
     * @return object
     */
    public function searchEmails(SearchRequest $request): object
    {

        return $this->emailService->applyFilter();
    }

    /**
     * fetch a emails for specified recipient email.
     *
     * @param string $email
     * @return object
     */
    public function fetchRecipientEmails(string $email): object
    {
        $emails = DB::table('emails')->where('to_email', $email)->orderBy('created_at', 'desc')->paginate(10);
        if (!$emails->total()) {
            return $this->error('Recipient email not found', Response::HTTP_NOT_FOUND, null);
        }

        return $emails;
    }

    /**
     * search and fetch emails for a recipient based on filter.
     * @param SearchRequest $request
     * @param $email
     * @return object
     */

    public function searchRecipientEmails(SearchRequest $request, $email): object
    {

        return $this->emailService->applyFilter($email);
    }


}
