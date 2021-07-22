<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Newsletter extends Model 
{   
    // protected $table = 'general_settings';
    protected $fillable = [
        'email'
    ];

    protected $casts = [
        
    ];
    
}
