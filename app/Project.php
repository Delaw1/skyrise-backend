<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model 
{   
    protected $fillable = [
        'name', 'type_id', 'address', 'city', 'featured', 'province', 'price', 'images', 'videos','feature_sheet',
         'condos', 'commercial', 'townhouse', 'floor_size', 'levels', 'maintenance_fees', 'developer_id',
        'architect', 'CD', 'project_website', 'contact_firstname', 'contact_lastname',
        'contact_phone', 'contact_email', 'zone', 'completion', 'amenities', 'description', 'floors', 'lot', 'f_d',
        'bedrooms', 'bathrooms', 'status', 'list_by', 'mls', 'country', 'lat', 'lng',

        'deposit_terms', 'agent_comm', 'completion_mnth', 'completion_year', 'sales_company', 'sales_address', 
        'designer', 'promotions', 'documents', 'published', 'owner', 'frontage', 'depth', 'interior_size'
    ];

    protected $casts = [
        'floors' => 'array',
        'amenities' => 'array',
        'promotions' => 'array',
        'documents' => 'array',
        'images' => 'array',
        'videos' => 'array',
        'feature_sheet' => 'array',
        'featured' => 'integer',
        'condos' => 'integer',
        'commercial' => 'integer',
        'townhouse' => 'integer',
        'type_id' => 'integer',
        'developer_id' => 'integer',
    ];
    public function types() {
        return $this->belongsTo('App\Type');
    }

    public function developer() {
        return $this->belongsTo('App\Developer');
    }
}
