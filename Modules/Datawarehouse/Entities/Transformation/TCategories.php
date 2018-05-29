<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 28-5-2018
 * Time: 13:22
 */

namespace Modules\Datawarehouse\Entities\Transformation;


use Exception;
use Modules\Datawarehouse\Entities\DwCategory;
use Modules\Datawarehouse\Entities\DwCourse;
use Modules\Datawarehouse\Entities\DwUser;
use Modules\Datawarehouse\Helpers\Anonymize;
use Modules\KalturaApi\Entities\KalturaCategory;

class TCategories
{
    /**
     * @var KalturaCategory
     */
    private $category;
    /**
     * @var Anonymize
     */
    private $anonymize;

    /**
     * TCategories constructor.
     * @param KalturaCategory $category
     * @param Anonymize $anonymize
     */
    public function __construct(
        KalturaCategory $category,
        Anonymize $anonymize
    )
    {
        $this->category = $category;
        $this->anonymize = $anonymize;
    }

    /**
     *  Transform data and import them in data warehouse
     */
    public function transformCategories() {
        $saCategories = $this->category->getAll();
        foreach ($saCategories as $key => $saCategory){
            /**
             * @var $saCategory KalturaCategory
             */
            $dwCategory = new DwCategory();
            $dwCategory->setId($saCategory->getId());
            $dwCategory->setParentId($saCategory->getParentId());
            $dwCategory->setDepth($saCategory->getDepth());
            $dwCategory->setName($saCategory->getName());
            $dwCategory->setCourseId($this->getCourseId($saCategory->getName()));
            $dwCategory->setFullIds($saCategory->getFullIds());
            $dwCategory->setOwner($this->getUserId($saCategory->getOwner()));
            $dwCategory->setCreatedAt($saCategory->getCreatedAt());
            $dwCategory->setUpdatedAt($saCategory->getUpdatedAt());
            try{
                $dwCategory->save();
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
    /**
     * Check if course exists
     *
     * @param $name
     * @return null|string
     */
    public function getCourseId($name) {
        /**
         * @var $dwCouse DwCourse
         */
        $dwCourse = DwCourse::query()->where(DwCourse::course_id,$name)->first();
        if ($dwCourse) {
            return $dwCourse->id;
        }
        return null;
    }

    /**
     * Check if user exists
     *
     * @param string $owner
     * @return mixed|null
     */
    public function getUserId($owner) {
        /**
         * @var $dwUser DwUser
         */
        $dwUser = DwUser::query()->where(
            DwUser::id,$this->anonymize->anonymizeUser($owner)
        )->first();
        if ($dwUser) {
            return $dwUser->id;
        }
        return null;
    }
}