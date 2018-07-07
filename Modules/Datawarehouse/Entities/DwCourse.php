<?php

namespace Modules\Datawarehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class DwCourse extends Model
{
    const course_id = 'course_id';
    const education_code = 'education_code';
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
    protected $primaryKey = 'id';

    /**
     * delete all in table
     */
    public function deleteAll(){
        DwCourse::query()->delete();
    }

    /**
     * @return string
     */
    public function getCourseId()
    {
        return $this->getAttribute(self::course_id);
    }

    /**
     * @param string $course_id
     */
    public function setCourseId(string $course_id)
    {
        $this->setAttribute(self::course_id, $course_id);
    }

    /**
     * @return string
     */
    public function getEducationCode()
    {
        return $this->getAttribute(self::education_code);
    }

    /**
     * @param string $education_code
     */
    public function setEducationCode($education_code)
    {
        $this->setAttribute(self::education_code, $education_code);
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
