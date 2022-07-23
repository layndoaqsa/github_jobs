<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'components';
    protected $guarded = ['created_at','updated_at'];
    public $timestamps  = true;
    protected $primaryKey = 'com_cd';
    public $incrementing = false;
    protected $keyType = 'string';
}
