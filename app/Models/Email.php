<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>   date("d/m/Y H:i", strtotime($value)),
        );



    }

}
