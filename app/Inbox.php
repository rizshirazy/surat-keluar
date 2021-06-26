<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Inbox extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'index',
        'origin',
        'reff',
        'date',
        'subject',
        'attachments',
        'category_id',
        'type_id',
        'user_id',
        'document',
        'status',
    ];

    protected $appends = [
        'user_disposition',
        'date_locale',
        'created_at_locale',
        'updated_at_locale',
        'date_formatted',
        'confidential'
    ];

    /**
     * Get the user associated with the Inbox
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the category associated with the Inbox
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get the type associated with the Inbox
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }

    /**
     * Get all of the disposition for the Inbox
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function disposition()
    {
        return $this->hasMany(Disposition::class, 'mail_id', 'id');
    }

    public function getUserDispositionAttribute()
    {
        return Disposition::select('user_id')->where('mail_id', $this->id)->get()->implode('user_id', ',');
    }

    public function getDateLocaleAttribute()
    {
        return Carbon::parse($this->date)->isoFormat('D MMMM Y');
    }

    public function getCreatedAtLocaleAttribute()
    {
        return Carbon::parse($this->created_at)->isoFormat('D MMMM Y');
    }
    public function getUpdatedAtLocaleAttribute()
    {
        return Carbon::parse($this->updated_at)->isoFormat('D MMMM Y');
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

        return $this->type_id == 2 && !in_array(Auth::id(), explode(',', $this->user_disposition));
    }
}
