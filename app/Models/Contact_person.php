<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_person extends Model
{
    use HasFactory;
    protected $table = 'contact_persons';
    public $timestamps = false;
}
