<?php

namespace Modules\Datawarehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class DwMediaEducation extends Model
{
    protected $fillable = [];

    const id = 'id';
    const media_id = 'media_id';
    const education_code = 'education_code';

    protected $table = 'dw_media_education';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * delete all in table
     */
    public function deleteAll(){
        DwMediaEducation::query()->delete();
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
    public function getEducationCode()
    {
        return $this->getAttribute(self::education_code);
    }

    /**
     * @param string $value
     */
    public function setEducationCode($value)
    {
        $this->setAttribute(self::education_code,$value);
    }
}
