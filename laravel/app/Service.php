<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

  protected $table = 'services';
  protected $guarded = [
  'id',
  'created_at',
  'updated_at'
  ];

  public function api_token() {
    return $this->hasOne('App\ApiToken');
  }
}
