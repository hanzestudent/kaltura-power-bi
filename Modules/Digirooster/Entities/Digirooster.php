<?php

namespace Modules\Digirooster\Entities;

use Illuminate\Database\Eloquent\Model;

class Digirooster extends Model
{
    protected $fillable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'id';
}
