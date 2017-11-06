<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $casts = [
        'choices' => 'array',
    ];

    public function user(){
        $this->belongsTo('App\User');
    }
}
