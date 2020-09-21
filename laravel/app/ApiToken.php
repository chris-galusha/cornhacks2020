<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ApiToken extends Authenticatable
{
  protected $table = 'api_tokens';
  protected $guarded = [
  'id',
  'created_at',
  'updated_at'
  ];

  public function service() {
    return $this->belongsTo('App\Service');
  }
}
