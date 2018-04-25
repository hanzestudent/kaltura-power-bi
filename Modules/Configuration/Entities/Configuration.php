<?php

namespace Modules\Configuration\Entities;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ["path","value"];
}
