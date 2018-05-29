<?php

namespace Modules\Datawarehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class DwCategoryEntry extends Model
{
    const id = 'id';
    const category_id = 'category_id';
    const media_id = 'media_id';
    const user_id = 'user_id';
    const category_full_ids = 'category_full_ids';
    const status = 'status';
    const created_at = 'created_at';

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
        DwCategoryEntry::query()->delete();
    }

    /**
     * get All rows
     */
    public function getAll() {
        return DwCategoryEntry::all();
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
    public function getCategoryId()
    {
        return $this->getAttribute(self::category_id);
    }

    /**
     * @param string $value
     */
    public function setCategoryId($value)
    {
        $this->setAttribute(self::category_id, $value);
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
        $this->setAttribute(self::media_id, $value);
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
    public function getCategoryFullIds()
    {
        return $this->getAttribute(self::category_full_ids);
    }

    /**
     * @param string $value
     */
    public function setCategoryFullIds($value)
    {
        $this->setAttribute(self::category_full_ids, $value);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->getAttribute(self::status);
    }

    /**
     * @param string $value
     */
    public function setStatus($value)
    {
        $this->setAttribute(self::status, $value);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getAttribute(self::created_at);
    }
}
