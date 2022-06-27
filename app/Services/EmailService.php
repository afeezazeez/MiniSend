<?php
namespace App\Services;

use App\Interfaces\IEmailService;
use App\Interfaces\IFileService;
use App\Models\Email;
use App\Helpers\Logger;
use Illuminate\Support\Str;
use App\Filters\StatusFilter;
use Illuminate\Http\Response;
use App\Filters\SubjectFilter;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponseStructure;
use App\Filters\FromAndToEmailsFilter;


class EmailService implements IEmailService
{

    use ApiResponseStructure;

    public $fileService;

    public function __construct(IFileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Store a newly created email and upload attachments.
     *
     * @param object $request
     * @return object
     */
    public function createAndSendEmail(object $request): object
    {

        try {

            DB::beginTransaction();

            // store the email database

            $emailData = [
                'to_email' => $request->to_email,
                'from_email' => $request->from_email,
                'subject' => Str::ScriptStripper($request->subject),
                'html_content' => $sanitized_content = Str::ScriptStripper($request->html_content),
                'text_content' => strip_tags($sanitized_content)
            ];


            $email = Email::create($emailData);
            // upload email attachments
            if ($request->hasFile('files')) {
                $this->fileService->uploadFiles($request->file('files'), $email);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Logger::logError($e);
            return $this->error('Error occured while sending email. Please try again', Response::HTTP_INTERNAL_SERVER_ERROR, null);

        }

        return $email;

    }

    /**
     * search and fetch emails based on filters.
     *
     * @param string|null $email
     * @return object
     */
    public function applyFilter(string $email = null): object
    {

        $query = DB::table('emails');

        $emails = app(Pipeline::class)
            ->send($query)
            ->through([
                StatusFilter::class,
                FromAndToEmailsFilter::class,
                SubjectFilter::class
            ])
            ->via('filter')
            ->thenReturn()
            ->when($email, function ($q) use ($email) {
                return $q->where('to_email', $email);
            })
            ->select('id', 'from_email', 'to_email', 'subject', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10)->withQueryString();
        return $emails;

    }

}

?>
