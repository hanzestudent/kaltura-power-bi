<?php

namespace Modules\Digirooster\Entities;

use Illuminate\Database\Eloquent\Model;

class Digirooster extends Model
{
    const id = 'id';
    const object_id = 'object_id';
    const name = 'name';
    const type = 'type';
    const location = 'location';
    const speaker_id = 'speaker_id';
    const class_id = 'class_id';
    const start_time_full = 'start_time_full';
    const end_time_full = 'end_time_full';
    const start_date = 'start_date';
    const start_time = 'start_time';
    const end_date = 'end_date';
    const end_time = 'end_time';

    protected $fillable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

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
    public function getSpeakerId()
    {
        return $this->getAttribute(self::speaker_id);
    }

    /**
     * @param string $value
     */
    public function setSpeakerId($value)
    {
        $this->setAttribute(self::speaker_id, $value);
    }

    /**
     * @return string
     */
    public function getClassId()
    {
        return $this->getAttribute(self::class_id);
    }

    /**
     * @param string $value
     */
    public function setClassId($value)
    {
        $this->setAttribute(self::class_id, $value);
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
    public function setEndTimeFull($value)
    {
        $this->setAttribute(self::end_time_full, $value);
    }
    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->getAttribute(self::start_date);
    }

    /**
     * @param string $value
     */
    public function setStartDate($value)
    {
        $this->setAttribute(self::start_date, $value);
    }
    /**
     * @return string
     */
    public function getStartTime()
    {
        return $this->getAttribute(self::end_time_full);
    }

    /**
     * @param string $value
     */
    public function setStartTime($value)
    {
        $this->setAttribute(self::end_time_full, $value);
    }
    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->getAttribute(self::end_date);
    }

    /**
     * @param string $value
     */
    public function setEndDate($value)
    {
        $this->setAttribute(self::end_date, $value);
    }
    /**
     * @return string
     */
    public function getEndTime()
    {
        return $this->getAttribute(self::end_time_full);
    }

    /**
     * @param string $value
     */
    public function setEndTime($value)
    {
        $this->setAttribute(self::end_time, $value);
    }
}
