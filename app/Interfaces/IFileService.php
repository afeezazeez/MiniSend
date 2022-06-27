<?php

namespace App\Interfaces;

use Closure;

// interface to be implemented by file service

interface IFileService
{

    public function uploadFiles(array $files, object $email);

    public  function generateFilePath(object $file);

}
