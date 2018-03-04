<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigurationContent extends Model
{
    protected $table = 'configuration_contents';

    protected $fillable = [
    	'title', 'content'
    ];
   

}
