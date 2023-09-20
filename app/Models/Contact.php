<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];
    protected $fillabale = ['first_name' , 'last_name' , 'address' , 'phone' , 'email' , 'company_id'  ];


    function company() {
        
        return $this->belongsTo(Company::class);
    }

    function tasks() {
        
        return $this->hasMany(Task::class);
    }

}
