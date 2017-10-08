<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    /**
     * @var string
     */
    protected $table = 'attachments';

    /**
     * @var array
     */
    protected $fillable = [
        'filename',
        'file_path'
    ];
}
