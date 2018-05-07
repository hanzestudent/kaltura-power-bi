<?php

namespace Modules\KalturaApi\Entities;

use Illuminate\Database\Eloquent\Model;

class KalturaMedia extends Model
{
    protected $fillable = [
        'kaltura_media_id'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * tell the model its not an integer
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'kaltura_media_id';
}
