<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'fullname',
        'email',
    ];
}
