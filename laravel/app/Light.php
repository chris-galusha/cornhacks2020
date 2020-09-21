<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Light extends Model
{
  protected $table = 'lights';
  protected $guarded = [
  'id',
  'created_at',
  'updated_at'
  ];
}
