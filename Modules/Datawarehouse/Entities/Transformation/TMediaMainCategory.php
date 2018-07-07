<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 31-5-2018
 * Time: 13:06
 */

namespace Modules\Datawarehouse\Entities\Transformation;
use Exception;
use Modules\Datawarehouse\Entities\DwCategory;
use Modules\Datawarehouse\Entities\DwCategoryEntry;
use Modules\Datawarehouse\Entities\DwMediaMainCategory;

/**
 * Class to only include main categories depth(0).
 *
 * Class TMediaMainCategory
 * @package Modules\Datawarehouse\Entities\Transformation
 */
class TMediaMainCategory
{
    /**
     * Transform categoryEntries to only include main categories
     */
    public function transformMainCategory() {
        $mainCategories = DwCategory::query()->where(
            DwCategory::depth,'=', 0
        )->get([DwCategory::id]);
        foreach ($mainCategories as $mainCategory) {
            /**
             * @var DwCategory $mainCategory
             */
            $mainCategoriesMedia = DwCategoryEntry::query()->where(
                DwCategoryEntry::category_full_ids, 'like', $mainCategory->getId().'%'
            )->groupBy(
                [DwCategoryEntry::media_id]
            )->get(
                [DwCategoryEntry::media_id]
            );
            foreach ($mainCategoriesMedia as $mainCategoryMedia) {
                /**
                 * @var DwCategoryEntry $mainCategoryMedia
                 */
                $dwMediaMainCategory = new DwMediaMainCategory();
                $dwMediaMainCategory->setCategoryId($mainCategory->getId());
                $dwMediaMainCategory->setMediaId($mainCategoryMedia->getMediaId());
                try {
                    $dwMediaMainCategory->save();
                } catch (Exception $exception) {
                    var_dump($exception->getMessage());
                }
            }
        }
    }
}