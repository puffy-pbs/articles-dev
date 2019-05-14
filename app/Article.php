<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'body_text', 'image_url', 'publish_on', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
