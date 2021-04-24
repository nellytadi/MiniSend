<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAttachment extends Model
{

    use HasFactory;
    protected array $fillable = ['email_id','attachment'];

    protected $primaryKey = 'email_id';
}
