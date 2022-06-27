<?php

namespace App\Interfaces;

use Closure;

// interface to be implemented by email service

interface IEmailService
{

    public function createAndSendEmail(object $request);

    public function applyFilter(string $email = null);

}
