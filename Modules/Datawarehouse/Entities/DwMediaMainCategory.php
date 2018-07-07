<?php

namespace Modules\Datawarehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class DwMediaMainCategory extends Model
{
    const id = 'id';
    const media_id = 'media_id';
    const category_id = 'category_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [];

    /**
     * delete all in table
     */
    public function deleteAll(){
        DwMediaMainCategory::query()->delete();
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
    public function getCategoryId()
    {
        return $this->getAttribute(self::category_id);
    }

    /**
     * @param string $value
     */
    public function setCategoryId($value)
    {
        $this->setAttribute(self::category_id,$value);
    }
}
