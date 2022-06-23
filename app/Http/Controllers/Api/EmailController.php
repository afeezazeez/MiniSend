<?php

namespace App\Http\Controllers\Api;

use App\Models\Email;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\FileService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseStructure;
use App\Http\Requests\SendEmailRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\EmailShowResource;

class EmailController extends Controller
{
    use ApiResponseStructure;

    // get all emails
    public function store(SendEmailRequest $request, FileService $fileService)
    {

        $path = "http://minisend.test/storage/uploads/1656022956-Screenshot_2022-06-10_at_18.21.59_(2).png";

        return $path;

        try{

            DB::beginTransaction();

                // store the email database
                $email =  Email::create(Arr::except($request->validated()  ,'files'));

                // upload email attachments
                if($request->hasFile('files')){
                    $fileService->uploadFiles($request->file('files'),$email);
                }

            DB::commit();
        }
        catch(\Exception $e){
           DB::rollBack();
           return $this->error($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR,null);
        }



        //send email through background job
        if($email){
            SendEmailJob::dispatch($email);
        }


        return $this->success(null,'Email sent successfully',Response::HTTP_CREATED);

    }
}
