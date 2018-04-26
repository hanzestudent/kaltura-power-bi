<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 25-4-2018
 * Time: 16:44
 */

namespace Modules\KalturaApi\Entities\Api;


use Kaltura\Client\Type\FilterPager;
use Kaltura\Client\Type\UserFilter;
use Kaltura\Client\Type\UserListResponse;
use Kaltura\Client\Enum\UserOrderBy;

/**
 * Model to call users
 *
 * Class User
 * @package Modules\KalturaApi\Entities\Api
 *
 */
class User
{
    /**
     * @var int
     */
    protected $createdAtGreaterThanOrEqual = '';

    /**
     * Order Users By
     *
     * @var string
     */
    protected $orderBy = UserOrderBy::CREATED_AT_ASC;

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
     * Get a list of all users in Kaltura
     *
     * @param $filter
     * @param $pager
     * @return bool|UserListResponse
     */
    public function list(UserFilter $filter, FilterPager $pager) {
        /**
         * @var \Kaltura\Client\Client $client
         */
        $client = $this->client->getClient();
        try {
            $result = $client->getUserService()->listAction(
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
     * Set Filter
     *
     * This filter is only used for users
     *
     * @param null $xml
     * @return UserFilter
     */
    public function getUserFilter($xml = null) {
        $userFilter = new UserFilter($xml);
        $userFilter->orderBy = $this->getOrderBy();
        $userFilter->createdAtGreaterThanOrEqual = $this->getCreatedAtGreaterThanOrEqual();
        return $userFilter;
    }

    /**
     * Filter option to get orderBy
     *
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


}