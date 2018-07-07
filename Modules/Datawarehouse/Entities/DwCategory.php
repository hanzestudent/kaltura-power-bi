<?php

namespace Modules\Datawarehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class DwCategory extends Model
{
    const id = 'id';
    const parent_id = 'parent_id';
    const depth = 'depth';
    const name = 'name';
    const course_id = 'course_id';
    const full_ids = 'full_ids';
    const owner = 'owner';
    const created_at = 'created_at';
    const updated_at = 'updated_at';

    protected $fillable = [];

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * delete all in table
     */
    public function deleteAll(){
        DwCategory::query()->delete();
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
     * @return int
     */
    public function getParentId()
    {
        return $this->getAttribute(self::parent_id);
    }

    /**
     * @param int $parentId
     */
    public function setParentId(int $parentId)
    {
        $this->setAttribute(self::parent_id,$parentId);
    }

    /**
     * @return int
     */
    public function getDepth()
    {
        return $this->getAttribute(self::depth);
    }

    /**
     * @param int $depth
     */
    public function setDepth(int $depth)
    {
        $this->setAttribute(self::depth,$depth);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getAttribute(self::name);
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->setAttribute(self::name,$name);
    }

    /**
     * @return int
     */
    public function getCourseId()
    {
        return $this->getAttribute(self::course_id);
    }

    /**
     * @param int|null $id
     */
    public function setCourseId($id)
    {
        $this->setAttribute(self::course_id,$id);
    }

    /**
     * @return string
     */
    public function getFullIds()
    {
        return $this->getAttribute(self::full_ids);
    }

    /**
     * @param string $fullIds
     */
    public function setFullIds(string $fullIds)
    {
        $this->setAttribute(self::full_ids,$fullIds);
    }

    /**
     * @return string
     */
    public function getOwner()
    {
        return $this->getAttribute(self::owner);
    }

    /**
     * @param string|null $owner
     */
    public function setOwner($owner)
    {
        $this->setAttribute(self::owner,$owner);
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
