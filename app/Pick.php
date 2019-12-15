<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pick extends Model
{
    protected $table = 'picks';
    protected $fillabe = [
        'nominee_id',
        'category_id',
        'user_id',
    ];

    public function category()
    {
        return $this->hasOne('App\Category');
    }

    public function nominee()
    {
        return $this->hasOne('App\Nominee');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
