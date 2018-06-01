<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 31-5-2018
 * Time: 13:03
 */

namespace Modules\Datawarehouse\Entities\Transformation;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Datawarehouse\Entities\DwMediaEducation;
use stdClass;

/**
 * Class to transform data and connect educations to media
 *
 * Class TMediaEducation
 * @package Modules\Datawarehouse\Entities\Transformation
 */
class TMediaEducation
{
    /**
     *  Add Media that has been added in the context in a course on blackboard.
     */
    public function transformMediaEducation() {
        $query = "
            SELECT dw_category_entries.media_id,dw_courses.education_code FROM `dw_category_entries` 
            inner join dw_categories as child
            on dw_category_entries.category_id = child.id and child.name = 'inContext'
            inner join dw_categories as parent
            on child.parent_id = parent.id
            inner join dw_courses
            on parent.course_id = dw_courses.id
            WHERE dw_category_entries.category_full_ids like '31042191%'
            and dw_courses.education_code is not null
        ";
        $results = DB::select( DB::raw(($query)));

        foreach ($results as $result) {
            /**
             * @var stdClass $result
             */
            $dwMediaEducation = new DwMediaEducation();
            $dwMediaEducation->setMediaId($result->media_id);
            $dwMediaEducation->setEducationCode($result->education_code);
            try {
                $dwMediaEducation->save();
            } catch (Exception $exception) {
                var_dump($exception->getMessage());
            }
        }
        $this->mediaAddedByTeacherUsingNormalWay();
    }

    /**
     * Add categories that have been added by teacher without putting it in the context
     */
    public function mediaAddedByTeacherUsingNormalWay() {
        $query = "
        SELECT dw_category_entries.media_id,dw_courses.education_code FROM `dw_category_entries` 
            inner join dw_categories as child
            on dw_category_entries.category_id = child.id
            inner join dw_courses
            on child.course_id = dw_courses.id
            WHERE dw_category_entries.category_full_ids like '31042191%'
            and dw_courses.education_code is not null
        ";

        $results = DB::select( DB::raw(($query)));

        foreach ($results as $result) {
            /**
             * @var stdClass $result
             */
            $dwMediaEducation = new DwMediaEducation();
            $dwMediaEducation->setMediaId($result->media_id);
            $dwMediaEducation->setEducationCode($result->education_code);
            try {
                $dwMediaEducation->save();
            } catch (Exception $exception) {
                var_dump($exception->getMessage());
            }
        }
    }
}