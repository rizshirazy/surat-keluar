<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Outbox extends Model
{
    use SoftDeletes;
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
        'document',
        'category_id',
        'user_id',
        'type_id'
    ];

    protected $appends = [
        'date_locale',
        'date_formatted',
        'confidential'
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

    /**
     * Get the type associated with the Outbox
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }

    /**
     * Get the user associated with the Outbox
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getDateLocaleAttribute()
    {
        return Carbon::parse($this->date)->isoFormat('D MMMM Y');
    }

    public function getDateFormattedAttribute()
    {
        return Carbon::parse($this->date)->format('d-m-Y');
    }

    public function getConfidentialAttribute()
    {
        if (!Auth::check()) {
            return true;
        }

        return $this->type_id == 2 && Auth::id() != $this->user_id;
    }
}
