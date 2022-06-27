<?php
namespace App\Services;

use App\Interfaces\IFileService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileService implements IFileService
{


    /**
     * upload all attachments for newly created email.
     * @param array $files
     * @param object $email
     * @return null
     */
    public function uploadFiles(array $files, object $email)
    {
        foreach ($files as $file) {
            $filePath = $this->generateFilePath($file);
            $fullPath = url('/') . '/storage/uploads/' . $filePath;
            $file->storeAs('public/uploads', $filePath);
            $email->attachments()->create([
                'filepath' => $fullPath,
                'filename' => $file->getClientOriginalName()
            ]);
        }

    }

    /**
     * compute file upload path.
     * @param object $file
     * @return string
     */
    public function generateFilePath(object $file): string
    {
        $clientName = str_replace(' ', '_', $file->getClientOriginalName());
        return time() . '-' . $clientName;
    }


}

?>
