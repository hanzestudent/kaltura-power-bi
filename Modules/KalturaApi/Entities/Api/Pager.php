<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 26-4-2018
 * Time: 09:42
 */

namespace Modules\KalturaApi\Entities\Api;

use Kaltura\Client\Type\FilterPager;

class Pager
{
    /**
     * Default page size
     *
     * Max is 500 objects
     *
     * @var int
     */
    protected $PageSize = 500;

    /**
     * Default start
     *
     * @var int
     */
    protected $pageIndex = 1;

    /**
     * Set Pager
     *
     * This can be used for multiple api services
     *
     * @param null|\SimpleXMLElement $xml
     * @return FilterPager
     */
    public function getFilterPager($xml = null) {
        $filterPager = new FilterPager($xml);
        $filterPager->pageSize = $this->getPageSize();
        $filterPager->pageIndex = $this->getPageIndex();
        return $filterPager;
    }

    /**
     * Set Page Index
     *
     * @param int $pageIndex
     */
    public function setPageIndex(int $pageIndex): void
    {
        $this->pageIndex = $pageIndex;
    }

    /**
     * Get PageIndex
     *
     * @return int
     */
    public function getPageIndex(): int
    {
        return $this->pageIndex;
    }

    /**
     * Set PageSize
     *
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->PageSize;
    }

    /**
     * Get PageSize
     *
     * @param int $PageSize
     */
    public function setPageSize(int $PageSize): void
    {
        $this->PageSize = $PageSize;
    }
}