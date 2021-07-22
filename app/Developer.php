<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Developer extends Model 
{   
    protected $fillable = [
        'name', 'address', 'city', 'province', 'postal_code',
        'website', 'contact_firstname', 'contact_lastname',
        'contact_phone', 'contact_email', 'country', 'unit'
    ];

    
    public function project() {
        return $this->hasMany('App\Project');
    }
}
