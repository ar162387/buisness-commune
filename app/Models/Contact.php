<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillabale = ['first_name' , 'last_name' , 'address' , 'phone' , 'email' , 'company_id'  ];


    function company() {
        
        return $this->belongsTo(Company::class);
    }

    function tasks() {
        
        return $this->hasMany(Task::class);
    }

}
