<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    protected $table = 'nominees';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

     /**
     * Get the post that owns the comment.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
