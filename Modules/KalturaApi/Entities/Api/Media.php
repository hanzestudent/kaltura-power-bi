<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 26-4-2018
 * Time: 14:22
 */

namespace Modules\KalturaApi\Entities\Api;


use Kaltura\Client\Enum\MediaEntryOrderBy;
use Kaltura\Client\Type\FilterPager;
use Kaltura\Client\Type\MediaEntryFilter;

class Media
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Unix timestamp
     *
     * @var int
     */
    protected $createdAtGreaterThanOrEqual = '';

    /**
     * Order Media By
     *
     * @var string
     */
    protected $orderBy = MediaEntryOrderBy::CREATED_AT_ASC;

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
     * Get a list of all media in Kaltura
     *
     * @param $filter
     * @param $pager
     * @return bool|\Kaltura\Client\Type\MediaListResponse
     */
    public function list(MediaEntryFilter $filter, FilterPager $pager) {
        /**
         * @var \Kaltura\Client\Client $client
         */
        $client = $this->client->getClient();
        try {
            $result = $client->getMediaService()->listAction(
                $filter,
                $pager
            );
        } catch (\Exception $e) {
            report($e);
            return false;
        }
        return $result;
    }

    public function getMediaFilter($xml = null) {
        $mediaFilter = new MediaEntryFilter($xml);
        $mediaFilter->orderBy = $this->getOrderBy();
        $mediaFilter->createdAtGreaterThanOrEqual = $this->getCreatedAtGreaterThanOrEqual();
        return $mediaFilter;
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