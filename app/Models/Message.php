<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * @var string
     */
    protected $table = 'messages';

    /**
     * @var array
     */
    protected $fillable = [
        'subject',
        'body',
        'sender_id',
        'receiver_id',
        'attachment',
        'thread_id',
    ];
}
