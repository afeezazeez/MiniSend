<?php
namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileService{



    public function uploadFiles($files,$email)
    {
        foreach ($files as $file ){
            $filePath = $this->generateFilePath($file);
            $fullPath = url('/').'/storage/uploads/'. $filePath;
            $file->storeAs('public/uploads',$filePath);
            $email->attachments()->create([
                'filepath'=>$fullPath
            ]);
        }

    }

    public function generateFilePath($file){
        $clientName = str_replace(' ', '_', $file->getClientOriginalName());
        return time() .'-'.$clientName.'.' . $file->getClientOriginalExtension();
    }


}

?>
