<?php


namespace App\Models;


class MailerPostman extends BaseModel
{
    protected $table = 'postman_letter';
    public $timestamps = false;

    protected $fillable = [ 'subject' , 'body' , 'recipients' , 'date_create'];
}