<?php

namespace Modules\Blackboard\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    const id = 'course_id';
    const name = 'name';
    const created_at = 'created_at';
    const number_of_enrolled_users = 'number_of_enrolled_users';

    protected $fillable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'course_id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * get all rows
     *
     * @return Collection|static[]
     */
    public function getAll() {
        return Course::all();
    }

    /**
     * @return string
     */
    public function getCourseId()
    {
        return $this->getAttribute(self::id);
    }

    /**
     * @param string $course_id
     */
    public function setCourseId(string $course_id)
    {
        $this->setAttribute(self::id, $course_id);
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->getAttribute(self::name);
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->setAttribute(self::name,$name);
    }

    /**
     * @return string
     */
    public function getCreatedAt() {
        return $this->getAttribute(self::created_at);
    }

    /**
     * @return string
     */
    public function getNumberOfEnrolledUsers() {
        return $this->getAttribute(self::number_of_enrolled_users);
    }

    /**
     * @param string $name
     */
    public function setNumberOfEnrolledUsers(string $name) {
        $this->setAttribute(self::number_of_enrolled_users,$name);
    }

}
