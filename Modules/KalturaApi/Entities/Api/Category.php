<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 1-5-2018
 * Time: 10:56
 */

namespace Modules\KalturaApi\Entities\Api;


use Kaltura\Client\Enum\CategoryOrderBy;
use Kaltura\Client\Type\CategoryFilter;
use Kaltura\Client\Type\CategoryListResponse;
use Kaltura\Client\Type\FilterPager;

class Category
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Order category By
     *
     * @var string
     */
    protected $orderBy = CategoryOrderBy::CREATED_AT_ASC;

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
     * Get a list of all category in Kaltura
     *
     * @param $filter
     * @param $pager
     * @return bool|CategoryListResponse
     */
    public function list(CategoryFilter $filter, FilterPager $pager) {
        /**
         * @var \Kaltura\Client\Client $client
         */
        $client = $this->client->getClient();
        try {
            $result = $client->getCategoryService()->listAction(
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
     * Create Filter for category
     *
     * @param null $xml
     * @return CategoryFilter
     */
    public function getCategoryFilter($xml = null) {
        $categoryFilter = new CategoryFilter($xml);
        $categoryFilter->orderBy = $this->getOrderBy();
        $categoryFilter->createdAtGreaterThanOrEqual = $this->getCreatedAtGreaterThanOrEqual();
        return $categoryFilter;
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