<?php

namespace Modules\Datawarehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class DwRecording extends Model
{
    const id = 'id';
    const title = 'title';
    const description = 'description';
    const tags = 'tags';
    const device = 'device';
    const creator_id = 'creator_id';
    const duration = 'duration';
    const recorded_at = 'recorded_at';
    const object_id = 'object_id';
    const name = 'name';
    const type = 'type';
    const location = 'location';
    const start_time_full = 'start_time_full';
    const end_time_full = 'end_time_full';

    protected $fillable = [];

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * delete all in table
     */
    public function deleteAll(){
        DwRecording::query()->delete();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getAttribute(self::id);
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->setAttribute(self::id,$id);
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

    /**
     * @return string
     */
    public function getObjectId()
    {
        return $this->getAttribute(self::object_id);
    }

    /**
     * @param string $value
     */
    public function setObjectId($value)
    {
        $this->setAttribute(self::object_id, $value);
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
    public function getType()
    {
        return $this->getAttribute(self::type);
    }

    /**
     * @param string $value
     */
    public function setType($value)
    {
        $this->setAttribute(self::type, $value);
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->getAttribute(self::location);
    }

    /**
     * @param string $value
     */
    public function setLocation($value)
    {
        $this->setAttribute(self::location, $value);
    }
    /**
     * @return string
     */
    public function getStartTimeFull()
    {
        return $this->getAttribute(self::start_time_full);
    }

    /**
     * @param string $value
     */
    public function setStartTimeFull($value)
    {
        $this->setAttribute(self::start_time_full, $value);
    }
    /**
     * @return string
     */
    public function getEndTimeFull()
    {
        return $this->getAttribute(self::end_time_full);
    }

    /**
     * @param string $value
     */
    public function setEndTimeFull(string $value)
    {
        $this->setAttribute(self::end_time_full, $value);
    }
}
