<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outbox extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'index',
        'suffix',
        'date',
        'subject',
        'destination',
        'category_id',
        'user_id',
    ];
}
