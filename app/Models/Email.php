<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $guarded= [];

    CONST EMAIL_POSTED_STATUS = 'Posted';
    CONST EMAIL_FAILED_STATUS = 'Failed';
    CONST EMAIL_SENT_STATUS = 'Sent';

    public function attachments()
    {
        return $this->hasMany(EmailAttachment::class);
    }
}
