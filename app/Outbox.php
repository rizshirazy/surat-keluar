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
        'reff',
        'date',
        'subject',
        'destination',
        'category_id',
        'user_id',
    ];


    /**
     * Get the category associated with the Outbox
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
