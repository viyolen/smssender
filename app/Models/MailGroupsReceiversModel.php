<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailGroupsReceiversModel extends Model
{
    use HasFactory;
    protected $fillable = ['id','user_id','group_id','email','name_surname'];
    protected $table = 'mail_groups_receivers';
}
