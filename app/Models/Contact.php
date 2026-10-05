<?php
// Tutorial 2 - Contact Management

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // Fields allowed for mass assignment (Contact::create)
    protected $fillable = [
        'name',
        'email',
    ];
}