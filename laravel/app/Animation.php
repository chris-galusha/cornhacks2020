<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animation extends Model
{
  protected $table = 'animations';
  protected $casts = [
        'data' => 'array',
    ];
  protected $guarded = [
  'id',
  'created_at',
  'updated_at'
  ];
}
