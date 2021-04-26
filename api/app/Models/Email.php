<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use Uuids;
    use HasFactory;

    protected  $fillable = ['user_id','from','to','subject','text_content','html_content','status'];

    public function emailAttachments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailAttachment::class);
    }
}
