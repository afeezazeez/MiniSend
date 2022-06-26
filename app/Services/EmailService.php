<?php
namespace App\Services;

use App\Filters\FromAndToEmailsFilter;
use App\Models\Email;
use Illuminate\Support\Arr;
use App\Filters\StatusFilter;
use App\Services\FileService;
use Illuminate\Http\Response;
use App\Filters\SubjectFilter;
use App\Helpers\Logger;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponseStructure;


class EmailService{

    use ApiResponseStructure;

    public $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function createAndSendEmail($request)
    {

        try{

            DB::beginTransaction();

                // store the email database

                //compute email text content
                $emailData =array_merge($request->validated(),['text_content' =>$request->html_content]);

                $email =  Email::create(Arr::except($emailData ,'files'));
                // upload email attachments
                if($request->hasFile('files')){
                    $this->fileService->uploadFiles($request->file('files'),$email);
                }

            DB::commit();
        }
        catch(\Exception $e){
           DB::rollBack();
           Logger::logError($e);
           return $this->error('Error occured while sending email. Please try again',Response::HTTP_INTERNAL_SERVER_ERROR,null);

        }

        return $email;

    }

    public function applyFilter($email=null)
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
        ->when($email, function($q) use ($email) {
            return $q->where('to_email', $email);
        })
        ->select('id','from_email','to_email','subject','status','created_at')
        ->orderBy('created_at','desc')
        ->paginate(10)->withQueryString();
        return $emails;

    }

}

?>
