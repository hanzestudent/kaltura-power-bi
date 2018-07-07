<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 28-5-2018
 * Time: 17:51
 */

namespace Modules\Datawarehouse\Entities\Transformation;


use Exception;
use Modules\Datawarehouse\Entities\DwCategory;
use Modules\Datawarehouse\Entities\DwCategoryEntry;
use Modules\Datawarehouse\Entities\DwMedia;
use Modules\Datawarehouse\Entities\DwUser;
use Modules\Datawarehouse\Helpers\Anonymize;
use Modules\KalturaApi\Entities\KalturaCategoryEntry;

class TCategoryEntries
{
    /**
     * @var Anonymize
     */
    private $anonymize;
    /**
     * @var KalturaCategoryEntry
     */
    private $categoryEntry;

    /**
     * TCategoryEntry constructor.
     * @param Anonymize $anonymize
     * @param KalturaCategoryEntry $categoryEntry
     */
    public function __construct(
        Anonymize $anonymize,
        KalturaCategoryEntry $categoryEntry
    )
    {
        $this->anonymize = $anonymize;
        $this->categoryEntry = $categoryEntry;
    }

    /**
     *  Transform data and import them in data warehouse
     */
    public function transformCategoryEntries() {
        $saCategoriesEntries = $this->categoryEntry->getAll();
        foreach ($saCategoriesEntries as $key => $saCategoriesEntry){
            /**
             * @var $saCategoriesEntry KalturaCategoryEntry
             */
            /*$media = $this->checkMedia($saCategoriesEntry->getMediaId());
            $category = $this->checkCategory($saCategoriesEntry->getCategoryId());
            if(!$media && !$category) {
                continue;
            }*/
            $dwCategoryEntry = new DwCategoryEntry();
            $dwCategoryEntry->setCategoryId($saCategoriesEntry->getCategoryId());
            $dwCategoryEntry->setMediaId($saCategoriesEntry->getMediaId());
            $dwCategoryEntry->setUserId(
                $this->getUserId($saCategoriesEntry->getUserId())
            );
            $dwCategoryEntry->setCategoryFullIds($saCategoriesEntry->getCategoryFullIds());
            $dwCategoryEntry->setStatus($saCategoriesEntry->getStatus());
            $dwCategoryEntry->setCreatedAt($saCategoriesEntry->getCreatedAt());
            try{
                $dwCategoryEntry->save();
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }

    /**
     * Check if media exists
     *
     * @param $mediaId
     * @return bool
     */
    public function checkMedia($mediaId) {
        $exists = DwMedia::query()->where(DwMedia::id,'=',$mediaId)->first();
        if($exists) {
            return true;
        }
        return false;
    }

    /**
     * Check if category exists
     *
     * @param $categoryId
     * @return bool
     */
    public function checkCategory($categoryId) {
        $exists = DwMedia::query()->where(DwCategory::id,'=',$categoryId)->first();
        if($exists) {
            return true;
        }
        return false;
    }
    /**
     * Check if user exists
     *
     * @param string $userId
     * @return mixed|null
     */
    public function getUserId($userId) {
        /**
         * @var $dwUser DwUser
         */
        if($userId) {
            $dwUser = DwUser::query()->where(
                DwUser::id, $this->anonymize->anonymizeUser($userId)
            )->first();
            if ($dwUser) {
                return $dwUser->id;
            }
        }
        return null;
    }
}