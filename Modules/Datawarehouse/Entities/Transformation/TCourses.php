<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 28-5-2018
 * Time: 11:39
 */

namespace Modules\Datawarehouse\Entities\Transformation;


use Exception;
use Modules\Blackboard\Entities\Course;
use Modules\Datawarehouse\Entities\DwCourse;
use Modules\Datawarehouse\Entities\DwEducation;

class TCourses
{
    /**
     * @var Course
     */
    private $course;

    /**
     * TCourses constructor.
     * @param Course $course
     */
    public function __construct(
        Course $course
    )
    {
        $this->course = $course;
    }

    /**
     *  Transform data and import them in data warehouse
     */
    public function transformCourses() {
        $saCourses = $this->course->getAll();
        foreach ($saCourses as $key => $saCourse){
            /**
             * @var $saCourse Course
             */
            $dwCourse = new DwCourse();
            $dwCourse->setCourseId($saCourse->getCourseId());
            $dwCourse->setEducationCode(
                $this->educationCode($saCourse->getCourseId())
            );
            $dwCourse->setName($saCourse->getName());
            $dwCourse->setCreatedAt($saCourse->getCreatedAt());
            $dwCourse->setNumberOfEnrolledUsers($saCourse->getNumberOfEnrolledUsers());
            try{
                $dwCourse->save();
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }

    /**
     * Check if education code exists
     *
     * @param $courseId
     * @return null|string
     */
    public function educationCode($courseId) {
        if(preg_match('/^[A-Za-z]{4}\./',$courseId, $match)) {
            /**
             * @var $dwEducation DwEducation
             */
            $dwEducation = DwEducation::query()->where(DwEducation::id,str_replace('.','', $match[0]))->first();
            if ($dwEducation) {
                return $dwEducation->getEducationCode();
            }
        }
        return null;
    }
}