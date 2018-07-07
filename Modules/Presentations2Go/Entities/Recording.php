<?php

namespace Modules\Presentations2Go\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Recording extends Model
{
    const title = 'title';
    const description = 'description';
    const tags = 'tags';
    const device = 'device';
    const creator_id = 'creator_id';
    const duration = 'duration';
    const recorded_at = 'recorded_at';

    protected $fillable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'title';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * Returns all users from staging area
     *
     * @return Collection|static[]
     */
    public function getAll() {
        return Recording::all();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getAttribute(self::title);
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->setAttribute(self::title,$title);
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
    public function getDevice()
    {
        return $this->getAttribute(self::device);
    }

    /**
     * @param string $value
     */
    public function setDevice($value)
    {
        $this->setAttribute(self::device, $value);
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
    public function getRecordedAt()
    {
        return $this->getAttribute(self::recorded_at);
    }

    /**
     * @param string $value
     */
    public function setRecordedAt($value)
    {
        $this->setAttribute(self::recorded_at, $value);
    }
}
