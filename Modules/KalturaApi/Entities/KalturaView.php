<?php

namespace Modules\KalturaApi\Entities;

use Illuminate\Database\Eloquent\Model;

class KalturaView extends Model
{
    protected $fillable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'view_id';
}
