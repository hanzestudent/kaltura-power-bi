<?php

namespace Modules\KalturaApi\Entities;

use Illuminate\Database\Eloquent\Model;

class KalturaCategoryEntry extends Model
{
    protected $fillable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'kaltura_category_entry_id';
}
