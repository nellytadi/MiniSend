<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected array $fillable = ['from','to','subject','text_content','html_content','status'];

    public function emailAttachments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailAttachment::class);
    }
}
