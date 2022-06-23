<?php
namespace App\Services;

use App\Models\Email;
use Illuminate\Support\Arr;
use App\Services\FileService;
use Illuminate\Http\Response;
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
                $email =  Email::create(Arr::except($request->validated()  ,'files'));

                // upload email attachments
                if($request->hasFile('files')){
                    $this->fileService->uploadFiles($request->file('files'),$email);
                }

            DB::commit();
        }
        catch(\Exception $e){
           DB::rollBack();
           return $this->error($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR,null);
        }

        return $email;

    }

}

?>
