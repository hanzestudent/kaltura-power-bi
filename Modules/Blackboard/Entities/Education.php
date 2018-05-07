<?php

namespace Modules\Blackboard\Entities;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'education_code';
}
