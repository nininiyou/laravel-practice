<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table='contact_me';

    protected $fillable = [
        'name', 'email', 'phone','message'
    ];
  
}