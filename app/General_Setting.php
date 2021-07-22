<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class General_Setting extends Model 
{   
    protected $table = 'general_settings';
    protected $fillable = [
        'company_name', 'address', 'city', 'province', 'postal_code',
         'contact_firstname', 'contact_lastname',
        'contact_phone', 'contact_email', 'amenities', 'videos'
    ];

    protected $casts = [
        'videos' => 'array',
        'amenities' => 'array'
    ];
    
}
