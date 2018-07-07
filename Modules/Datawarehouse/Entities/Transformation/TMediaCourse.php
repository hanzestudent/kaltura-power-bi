<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 31-5-2018
 * Time: 13:04
 */

namespace Modules\Datawarehouse\Entities\Transformation;


use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Datawarehouse\Entities\DwMediaCourse;
use stdClass;

class TMediaCourse
{
    /**
     * Transform categoryEntries to only include courses
     */
    /**
     *  Add Media that has been added in the context in a course on blackboard.
     */
    public function transformMediaCourse() {
        $query = "
            SELECT dw_category_entries.media_id,parent.course_id FROM `dw_category_entries` 
            inner join dw_categories as child
            on dw_category_entries.category_id = child.id and child.name = 'inContext'
            inner join dw_categories as parent
            on child.parent_id = parent.id
            WHERE dw_category_entries.category_full_ids like '31042191%'
            and parent.course_id is not null
        ";
        $results = DB::select( DB::raw(($query)));

        foreach ($results as $result) {
            /**
             * @var stdClass $result
             */
            $dwMediaCourse = new DwMediaCourse();
            $dwMediaCourse->setMediaId($result->media_id);
            $dwMediaCourse->setCourseId($result->course_id);
            try {
                $dwMediaCourse->save();
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
        SELECT dw_category_entries.media_id,child.course_id FROM `dw_category_entries` 
        inner join dw_categories as child
        on dw_category_entries.category_id = child.id
        WHERE dw_category_entries.category_full_ids like '31042191%'
        and course_id is not null
        ";

        $results = DB::select( DB::raw(($query)));

        foreach ($results as $result) {
            /**
             * @var stdClass $result
             */
            $dwMediaCourse = new DwMediaCourse();
            $dwMediaCourse->setMediaId($result->media_id);
            $dwMediaCourse->setCourseId($result->course_id);
            try {
                $dwMediaCourse->save();
            } catch (Exception $exception) {
                var_dump($exception->getMessage());
            }
        }
    }
}