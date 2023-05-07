<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
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

  /**
   * ContactFormからContactへ変換する
   *
   * @return array
   */
  public function toContact()
  {
    return [
      'last_name' => $this->last_name,
      'first_name' => $this->first_name,
      'gender' => $this->gender,
      'email' => $this->email,
      'postcode' => $this->postcode,
      'address' => $this->address,
      'building_name' => $this->building_name,
      'opinion' => $this->opinion,
    ];
  }
}
