<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'messages';

    protected $fillable = ['body'];

    protected $appends = ['selfMessage'];

    public function getSelfMessageAttribute()
    {
        return $this->user_id === auth()->user()->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
