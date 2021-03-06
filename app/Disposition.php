<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disposition extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mail_id',
        'user_id',
        'notes',
        'status'
    ];

    /**
     * Get the user associated with the Disposition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the mail associated with the Disposition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mail()
    {
        return $this->hasOne(Inbox::class, 'id', 'mail_id');
    }
}
