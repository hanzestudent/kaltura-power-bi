<?php

namespace Modules\Blackboard\Entities;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'course_id';
}
