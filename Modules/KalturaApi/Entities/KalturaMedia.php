<?php

namespace Modules\KalturaApi\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class KalturaMedia extends Model
{
    const id = 'kaltura_media_id';
    const name = 'name';
    const description = 'description';
    const media_type = 'media_type';
    const source_type = 'source_type';
    const duration = 'duration';
    const ms_duration = 'ms_duration';
    const user_id = 'kaltura_user_id';
    const creator_id = 'kaltura_creator_id';
    const tags = 'tags';
    const moderation_status = 'moderation_status';
    const replacement_status = 'replacement_status';
    const root_entry_id = 'root_entry_id';
    const created_at = 'created_at';
    const updated_at = 'updated_at';

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


    /**
     * get all rows
     *
     * @return Collection|static[]
     */
    public function getAll() {
        return KalturaMedia::all();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getAttribute(self::id);
    }

    /**
     * @param string $value
     */
    public function setId($value)
    {
        $this->setAttribute(self::id, $value);
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getAttribute(self::name);
    }

    /**
     * @param string $value
     */
    public function setName($value)
    {
        $this->setAttribute(self::name, $value);
    }
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getAttribute(self::description);
    }

    /**
     * @param string $value
     */
    public function setDescription($value)
    {
        $this->setAttribute(self::description, $value);
    }
    /**
     * @return string
     */
    public function getMediaType()
    {
        return $this->getAttribute(self::media_type);
    }

    /**
     * @param string $value
     */
    public function setMediaType($value)
    {
        $this->setAttribute(self::media_type, $value);
    }
    /**
     * @return string
     */
    public function getSourceType()
    {
        return $this->getAttribute(self::source_type);
    }

    /**
     * @param string $value
     */
    public function setSourceType($value)
    {
        $this->setAttribute(self::source_type, $value);
    }
    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->getAttribute(self::duration);
    }

    /**
     * @param string $value
     */
    public function setDuration($value)
    {
        $this->setAttribute(self::duration, $value);
    }
    /**
     * @return string
     */
    public function getMsDuration()
    {
        return $this->getAttribute(self::ms_duration);
    }

    /**
     * @param string $value
     */
    public function setMsDuration($value)
    {
        $this->setAttribute(self::ms_duration, $value);
    }
    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->getAttribute(self::user_id);
    }

    /**
     * @param string $value
     */
    public function setUserId($value)
    {
        $this->setAttribute(self::user_id, $value);
    }
    /**
     * @return string
     */
    public function getCreatorId()
    {
        return $this->getAttribute(self::creator_id);
    }

    /**
     * @param string $value
     */
    public function setCreatorId($value)
    {
        $this->setAttribute(self::creator_id, $value);
    }
    /**
     * @return string
     */
    public function getTags()
    {
        return $this->getAttribute(self::tags);
    }

    /**
     * @param string $value
     */
    public function setTags($value)
    {
        $this->setAttribute(self::tags, $value);
    }
    /**
     * @return string
     */
    public function getModerationStatus()
    {
        return $this->getAttribute(self::moderation_status);
    }

    /**
     * @param string $value
     */
    public function setModerationStatus($value)
    {
        $this->setAttribute(self::moderation_status, $value);
    }
    /**
     * @return string
     */
    public function getReplacementStatus()
    {
        return $this->getAttribute(self::replacement_status);
    }

    /**
     * @param string $value
     */
    public function setReplacementStatus($value)
    {
        $this->setAttribute(self::replacement_status, $value);
    }
    /**
     * @return string
     */
    public function getRootEntryId()
    {
        return $this->getAttribute(self::root_entry_id);
    }

    /**
     * @param string $value
     */
    public function setRootEntryId($value)
    {
        $this->setAttribute(self::root_entry_id, $value);
    }
    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getAttribute(self::created_at);
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getAttribute(self::updated_at);
    }
}
