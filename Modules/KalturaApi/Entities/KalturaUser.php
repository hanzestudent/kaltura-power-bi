<?php

namespace Modules\KalturaApi\Entities;

use Illuminate\Database\Eloquent\Model;

class KalturaUser extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'kaltura_user_id',
        'status',
        'created_at',
        'updated_at',
        'object_type'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'kaltura_user_id';

}
