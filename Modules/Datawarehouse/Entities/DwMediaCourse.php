<?php

namespace Modules\Datawarehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class DwMediaCourse extends Model
{
    const id = 'id';
    const media_id = 'media_id';
    const course_id = 'course_id';

    protected $fillable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * delete all in table
     */
    public function deleteAll(){
        DwMediaCourse::query()->delete();
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
        $this->setAttribute(self::id,$value);
    }

    /**
     * @return string
     */
    public function getMediaId()
    {
        return $this->getAttribute(self::media_id);
    }

    /**
     * @param string $value
     */
    public function setMediaId($value)
    {
        $this->setAttribute(self::media_id,$value);
    }

    /**
     * @return string
     */
    public function getCourseId()
    {
        return $this->getAttribute(self::course_id);
    }

    /**
     * @param string $value
     */
    public function setCourseId($value)
    {
        $this->setAttribute(self::course_id,$value);
    }
}
