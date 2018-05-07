<?php

namespace Modules\KalturaApi\Console;

use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Kaltura\Client\Type\ReportGraph;
use Modules\KalturaApi\Entities\KalturaMedia;
use Modules\KalturaApi\Entities\Api\Pager;
use Modules\KalturaApi\Entities\Api\Report;
use Modules\KalturaApi\Entities\KalturaView;

class CreateKalturaViews extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:kaltura:views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Kaltura Views from Kaltura VPaas Api';
    /**
     * @var Report
     */
    private $report;
    /**
     * @var Pager
     */
    private $pager;
    /**
     * @var KalturaMedia
     */
    private $kalturaMedia;

    /**
     * Create a new command instance.
     *
     * @param Report $report
     * @param Pager $pager
     * @param KalturaMedia $kalturaMedia
     */
    public function __construct(
        Report $report,
        Pager $pager,
        KalturaMedia $kalturaMedia
    )
    {
        parent::__construct();
        $this->report = $report;
        $this->pager = $pager;
        $this->kalturaMedia = $kalturaMedia;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $media = KalturaMedia::where('last_synced','<',date('Ymd'))->take(500)->get();
        foreach ($media as $mediaEntry) {
            $this->info( $mediaEntry->kaltura_media_id);
            if($mediaEntry->last_synced > 0) {
                $this->report->setFromDay($mediaEntry->last_synced);
            } else {
                $this->report->setFromDay('19800101');
            }
            $this->report->setToDay(date('Ymd'));
            $responseGraph = $this->report->getGraphs(
                $this->report->getReportInputFilter(),
                '',
                $mediaEntry->kaltura_media_id
            );
            $countPlaysReport = $this->getCountPlays($responseGraph);
            if($countPlaysReport && $countPlaysReport->data) {
                $countPlaysReportRows = str_getcsv($countPlaysReport->data,';');
                foreach ($countPlaysReportRows as $countPlaysReportRow) {
                     $row = explode(',',$countPlaysReportRow);
                     var_dump($row);
                     /**
                      * $row[0] = the date
                      * $row[1] = how many times it has been played
                      */
                     if($row) {
                         $result = $this->addKalturaViews($mediaEntry->kaltura_media_id, $row);
                     }
                }
            }
            if($result) {
                $mediaEntry->last_synced = date("Ymd");
                $mediaEntry->save();
            }
        }
    }

    /**
     * @param $mediaId
     * @param array $row
     * @return bool
     */
    public function addKalturaViews($mediaId, $row) {
        $pageIndex = 0;
        $this->report->setFromDay($row[0]);
        $this->report->setToDay($row[0]);
        $tableReportInputFilter = $this->report->getReportInputFilter();

        $responseTotalCount = $this->report->getTable (
            $tableReportInputFilter,
            $this->pager->getFilterPager(),
            '',
            $mediaId
        );
        if($responseTotalCount) {
            for ($i = 0; $i < $responseTotalCount->totalCount; $i = $i + $this->pager->getPageSize()) {
                $pageIndex++;
                $this->pager->setPageIndex($pageIndex);
                $responseTable = $this->report->getTable (
                    $tableReportInputFilter,
                    $this->pager->getFilterPager(),
                    '',
                    $mediaId
                );
                if($responseTable && $responseTable->data) {
                    $playViewReportRows = str_getcsv($responseTable->data, ';');
                    foreach ($playViewReportRows as $playViewReportRow) {
                        if(!empty($playViewReportRow)){
                        $playViewReportRowArray = explode(',',$playViewReportRow);
                            $dtime = DateTime::createFromFormat("Ymd", $row[0]);
                            $timestamp = $dtime->getTimestamp();
                            $kalturaView = new KalturaView();
                            $kalturaView->kaltura_user_id = $playViewReportRowArray[0];
                            $kalturaView->kaltura_media_id = $mediaId;
                            $kalturaView->played_at = date("Y-m-d H:i:s", $timestamp);
                            $kalturaView->count_plays = $playViewReportRowArray[2];
                            $kalturaView->sum_time_viewed = $playViewReportRowArray[3];
                            $kalturaView->avg_time_viewed = $playViewReportRowArray[4];
                            $kalturaView->avg_view_drop_off = $playViewReportRowArray[5];
                            $kalturaView->count_loads = $playViewReportRowArray[6];
                            $kalturaView->load_play_ratio = $playViewReportRowArray[7];
                            try {
                                $kalturaView->save();
                            } catch (\Exception $e){
                                Log::warning('media '. $mediaId . 'Could not be added');
                                return false;
                            }
                        }
                    }
                }
            }
        }
        return true;
    }

    /**
     * Only retrieve count_plays
     *
     * @param array $response
     * @return ReportGraph | false
     */
    protected function getCountPlays($response) {
        $report = false;
        foreach ($response as $report) {
            if($report->id == "count_plays") {
                break;
            }
        }
        return $report;
    }
}
