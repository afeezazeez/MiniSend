<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory;

    protected $guarded = [];

    const EMAIL_POSTED_STATUS = 'Posted';
    const EMAIL_FAILED_STATUS = 'Failed';
    const EMAIL_SENT_STATUS = 'Sent';

    public function attachments()
    {
        return $this->hasMany(EmailAttachment::class);
    }

    /**
     * Get the email's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date("d/m/Y H:i", strtotime($value)),
        );


    }

}
