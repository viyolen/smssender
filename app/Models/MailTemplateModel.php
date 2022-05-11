<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplateModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'mail_templates';
}
