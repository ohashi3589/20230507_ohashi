<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ContactFactory;

class Contact extends Model
{
  use HasFactory;

  protected $fillable = [
    'last_name',
    'first_name',
    'fullname',
    'gender',
    'email',
    'postcode',
    'address',
    'building_name',
    'opinion',
  ];

  protected static function newFactory()
  {
    return ContactFactory::new();
  }
}
