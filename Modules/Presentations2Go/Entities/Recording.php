<?php

namespace Modules\Presentations2Go\Entities;

use Illuminate\Database\Eloquent\Model;

class recording extends Model
{
    protected $fillable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'title';
}
