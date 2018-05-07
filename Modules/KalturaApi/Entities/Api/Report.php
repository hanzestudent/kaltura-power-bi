<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 2-5-2018
 * Time: 13:38
 */

namespace Modules\KalturaApi\Entities\Api;


use Exception;
use Kaltura\Client\Enum\ReportType;
use Kaltura\Client\Type\FilterPager;
use Kaltura\Client\Type\ReportInputFilter;

class Report
{
    /**
     * This report shows everyone that have seen the video on a specific time
     *
     * @var string
     */
    protected $reportType = ReportType::USER_ENGAGEMENT;

    /**
     * from day
     *
     * Y = year
     * M = month
     * D = day
     *
     * FORMAT of day is YYYYMMDD
     *
     * @var string
     */
    protected $fromDay = '19800101';

    /**
     * to day
     *
     * Y = year
     * M = month
     * D = day
     *
     * FORMAT of day is YYYYMMDD
     *
     * @var string
     */
    protected $toDay;

    /**
     * @var Client
     */
    private $client;

    /**
     * User constructor.
     * @param Client $client
     */
    public function __construct(
        Client $client
    )
    {
        $this->client = $client;
    }

    /**
     * Returns a graph with all dates a video or videos have been shown.
     *
     * @param ReportInputFilter $reportInputFilter
     * @param $dimension
     * @param string $objectIds .
     *
     * @return array|bool
     */
    public function getGraphs(
        ReportInputFilter $reportInputFilter,
        $dimension,
        string $objectIds
    ) {
        /**
         * @var \Kaltura\Client\Client $client
         */
        $reportType = $this->getReportType();
        $client = $this->client->getClient();
        try {
            $result = $client->getReportService()->getGraphs(
                $reportType,
                $reportInputFilter,
                $dimension,
                $objectIds
            );
        } catch (Exception $e) {
            report($e);
            return false;
        }
        return $result;
    }

    /**
     * Returns a table with all viewer that have watched object_id
     *
     * @param ReportInputFilter $reportInputFilter
     * @param FilterPager $pager
     * @param $order
     * @param string $objectIds
     * @return bool|\Kaltura\Client\Type\ReportTable
     */
    public function getTable(
        ReportInputFilter $reportInputFilter,
        FilterPager $pager,
        $order,
        string $objectIds
    ) {
        /**
         * @var \Kaltura\Client\Client $client
         */
        $reportType = $this->getReportType();
        $client = $this->client->getClient();
        try {
            $result = $client->getReportService()->getTable(
                $reportType,
                $reportInputFilter,
                $pager,
                $order,
                $objectIds
            );
        } catch (Exception $e) {
            report($e);
            return false;
        }
        return $result;
    }

    /**
     * Create Filter for reports
     *
     * @param null $xml
     * @return ReportInputFilter
     */
    public function getReportInputFilter($xml = null) {
        $reportInputFilter = new ReportInputFilter($xml);
        $reportInputFilter->fromDay = $this->getFromDay();
        $reportInputFilter->toDay = $this->getToDay();
        return $reportInputFilter;
    }

    /**
     * @return string
     */
    public function getReportType(): string
    {
        return $this->reportType;
    }

    /**
     * @param string $reportType
     */
    public function setReportType(string $reportType): void
    {
        $this->reportType = $reportType;
    }

    /**
     * @return string
     */
    public function getToDay(): string
    {
        if(!$this->toDay) {
            $this->toDay = date('Ymd');
        }
        return $this->toDay;
    }

    /**
     * @param string $toDay
     */
    public function setToDay(string $toDay): void
    {
        $this->toDay = $toDay;
    }

    /**
     * @return string
     */
    public function getFromDay(): string
    {
        return $this->fromDay;
    }

    /**
     * @param string $fromDay
     */
    public function setFromDay(string $fromDay): void
    {
        $this->fromDay = $fromDay;
    }


}