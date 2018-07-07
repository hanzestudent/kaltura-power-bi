<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 28-5-2018
 * Time: 18:27
 */

namespace Modules\Datawarehouse\Entities\Transformation;


use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Datawarehouse\Entities\DwViews;
use Modules\Datawarehouse\Helpers\Anonymize;
use Modules\KalturaApi\Entities\KalturaView;

class TView
{
    /**
     * @var KalturaView
     */
    private $view;
    /**
     * @var Anonymize
     */
    private $anonymize;

    /**
     * TView constructor.
     * @param KalturaView $view
     * @param Anonymize $anonymize
     */
    public function __construct(
        KalturaView $view,
        Anonymize $anonymize
    )
    {
        $this->view = $view;
        $this->anonymize = $anonymize;
    }

    /**
     *
     */
    public function transformViews() {

        for ($skip = 0; $skip <= 750000; $skip = $skip + 50000) {
            $saViews = KalturaView::query()->skip($skip)->take(50000)->get();
            foreach ($saViews as $key => $saView) {
                /**
                 * @var $saView KalturaView
                 */
                $dwView = new DwViews();
                $dwView->setUserId($this->anonymize->anonymizeUser($saView->getUserId()));
                $dwView->setMediaId($saView->getMediaId());
                $dwView->setPlayedAt($saView->getPlayedAt());
                $dwView->setCountPlays($saView->getCountPlays());
                $dwView->setSumTimeViewed($saView->getSumTimeViewed());
                $dwView->setAvgTimeViewed($saView->getAvgTimeViewed());
                $dwView->setAvgViewDropOff($saView->getAvgTimeViewed());
                $dwView->setCountLoads($saView->getCountLoads());
                $dwView->setLoadPlayRatio($saView->getLoadPlayRatio());
                try {
                    $query = $this->insertOrUpdate($dwView);
                    DB::select( DB::raw(($query)));
                } catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            };
        }
    }

    /**
     * @param DwViews $dwView
     * @return string
     */
    protected function insertOrUpdate($dwView){
        $query = "INSERT INTO `dw_views`(".DwViews::user_id.", 
        ".DwViews::media_id.", 
        ".DwViews::played_at.",
        ".DwViews::count_plays.",
        ".DwViews::sum_time_viewed.",
        ".DwViews::avg_time_viewed.",
        ".DwViews::avg_view_drop_off.",
        ".DwViews::count_loads.",
        ".DwViews::load_play_ratio."
        ) VALUES (
        '".$dwView->getUserId()."', 
        '".$dwView->getMediaId()."',
        '".$dwView->getPlayedAt()."', 
        ".$dwView->getCountPlays().", 
        ".$dwView->getSumTimeViewed().", 
        ".$dwView->getAvgTimeViewed().", 
        ".$dwView->getAvgViewDropOff().", 
        ".$dwView->getCountLoads().", 
        ".$dwView->getLoadPlayRatio()."
        )
        ON DUPLICATE KEY 
        UPDATE 
        ".DwViews::user_id." = '".$dwView->getUserId()."',
        ".DwViews::media_id." = '".$dwView->getMediaId()."',
        ".DwViews::played_at." = '".$dwView->getPlayedAt()."'";
        return $query;
    }
}