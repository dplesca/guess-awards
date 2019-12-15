<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $hidden = [
        'id',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function nominees()
    {
        return $this->hasMany('App\Nominee');
    }
}
