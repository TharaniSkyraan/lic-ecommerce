<?php

namespace Sky\LicEcommerce\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    
    protected $fillable = ['user_name','product_key','license_key'];
}
