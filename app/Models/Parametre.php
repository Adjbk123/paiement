<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    protected $table="parametres";

    protected $fillable =[
        'website_name' ,
        'website_url' ,
        
        'meta_description' ,

        'address' ,
        'phone1' ,
        'phone2' ,
        'email1' ,
        'email2' ,

        'facebook' ,
        'twitter' ,
        'instagram' ,
        'youtube' ,
        'photo' 
    ];
}
