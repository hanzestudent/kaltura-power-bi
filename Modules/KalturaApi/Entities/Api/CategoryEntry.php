<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 1-5-2018
 * Time: 10:56
 */

namespace Modules\KalturaApi\Entities\Api;


use Kaltura\Client\Enum\CategoryEntryOrderBy;
use Kaltura\Client\Type\CategoryEntryFilter;
use Kaltura\Client\Type\CategoryEntryListResponse;
use Kaltura\Client\Type\FilterPager;

class CategoryEntry
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Order Category Entry By
     *
     * @var string
     */
    protected $orderBy = CategoryEntryOrderBy::CREATED_AT_ASC;

    /**
     * Unix timestamp
     *
     * @var int
     */
    protected $createdAtGreaterThanOrEqual = '';

    /**
     * Category constructor.
     * @param Client $client
     */
    public function __construct(
        Client $client
    )
    {
        $this->client = $client;
    }

    /**
     * Get a list of all category entries in Kaltura
     *
     * @param $filter
     * @param $pager
     * @return bool|CategoryEntryListResponse
     */
    public function list(CategoryEntryFilter $filter, FilterPager $pager) {
        /**
         * @var \Kaltura\Client\Client $client
         */
        $client = $this->client->getClient();
        try {
            $result = $client->getCategoryEntryService()->listAction(
                $filter,
                $pager
            );
        } catch (\Exception $e) {
            report($e);
            return false;
        }
        return $result;
    }

    /**
     * Create Filter for category entry
     *
     * @param null $xml
     * @return CategoryEntryFilter
     */
    public function getCategoryEntryFilter($xml = null) {
        $categoryEntryFilter = new CategoryEntryFilter($xml);
        $categoryEntryFilter->orderBy = $this->getOrderBy();
        $categoryEntryFilter->createdAtGreaterThanOrEqual = $this->getCreatedAtGreaterThanOrEqual();
        return $categoryEntryFilter;
    }

    /**
     * @return int
     */
    public function getCreatedAtGreaterThanOrEqual(): int
    {
        return $this->createdAtGreaterThanOrEqual;
    }

    /**
     * @param int $createdAtGreaterThanOrEqual
     */
    public function setCreatedAtGreaterThanOrEqual(int $createdAtGreaterThanOrEqual): void
    {
        $this->createdAtGreaterThanOrEqual = $createdAtGreaterThanOrEqual;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * @param string $orderBy
     */
    public function setOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }
}