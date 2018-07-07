<?php

namespace Modules\KalturaApi\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class KalturaUser extends Model
{
    /**
     * @var string
     */
    const id = 'kaltura_user_id';

    /**
     * @var integer
     */
    const status = 'status';

    /**
     * @var bool
     */
    public $incrementing = false;

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

    /**
     * Returns all users from staging area
     *
     * @return Collection|static[]
     */
    public function getAll() {
        return KalturaUser::all();
    }

    /**
     * @return string
     */
    public function getKalturaUserId(): string
    {
        return $this->getAttribute(self::id);
    }

    /**
     * @param string $kaltura_user_id
     */
    public function setKalturaUserId(string $kaltura_user_id): void
    {
        $this->setAttribute(self::id,$kaltura_user_id);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->getAttribute(self::status);
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->setAttribute(self::status,$status);
    }
}
