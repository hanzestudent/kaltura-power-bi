<?php

namespace Modules\KalturaApi\Entities;

use Illuminate\Database\Eloquent\Model;

class KalturaView extends Model
{
    const id = 'view_id';
    const user_id  = 'kaltura_user_id';
    const media_id  = 'kaltura_media_id';
    const played_at = 'played_at';
    const count_plays = 'count_plays';
    const sum_time_viewed = 'sum_time_viewed';
    const avg_time_viewed = 'avg_time_viewed';
    const avg_view_drop_off = 'avg_view_drop_off';
    const count_loads = 'count_loads';
    const load_play_ratio = 'load_play_ratio';

    protected $fillable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'view_id';

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getAttribute(self::id);
    }

    /**
     * @param string $value
     */
    public function setId($value)
    {
        $this->setAttribute(self::id,$value);
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->getAttribute(self::user_id);
    }

    /**
     * @param string $value
     */
    public function setUserId($value)
    {
        $this->setAttribute(self::user_id,$value);
    }

    /**
     * @return string
     */
    public function getMediaId()
    {
        return $this->getAttribute(self::media_id);
    }

    /**
     * @param string $value
     */
    public function setMediaId($value)
    {
        $this->setAttribute(self::media_id,$value);
    }

    /**
     * @return string
     */
    public function getPlayedAt()
    {
        return $this->getAttribute(self::played_at);
    }

    /**
     * @param string $value
     */
    public function setPlayedAt($value)
    {
        $this->setAttribute(self::played_at,$value);
    }

    /**
     * @return string
     */
    public function getCountPlays()
    {
        return $this->getAttribute(self::count_plays);
    }

    /**
     * @param string $value
     */
    public function setCountPlays($value)
    {
        $this->setAttribute(self::count_plays,$value);
    }

    /**
     * @return string
     */
    public function getSumTimeViewed()
    {
        return $this->getAttribute(self::sum_time_viewed);
    }

    /**
     * @param string $value
     */
    public function setSumTimeViewed($value)
    {
        $this->setAttribute(self::sum_time_viewed,$value);
    }

    /**
     * @return string
     */
    public function getAvgTimeViewed()
    {
        return $this->getAttribute(self::avg_time_viewed);
    }

    /**
     * @param string $value
     */
    public function setAvgTimeViewed($value)
    {
        $this->setAttribute(self::avg_time_viewed,$value);
    }

    /**
     * @return string
     */
    public function getAvgViewDropOff()
    {
        return $this->getAttribute(self::avg_view_drop_off);
    }

    /**
     * @param string $value
     */
    public function setAvgViewDropOff($value)
    {
        $this->setAttribute(self::avg_view_drop_off,$value);
    }

    /**
     * @return string
     */
    public function getCountLoads()
    {
        return $this->getAttribute(self::count_loads);
    }

    /**
     * @param string $value
     */
    public function setCountLoads($value)
    {
        $this->setAttribute(self::count_loads,$value);
    }

    /**
     * @return string
     */
    public function getLoadPlayRatio()
    {
        return $this->getAttribute(self::load_play_ratio);
    }

    /**
     * @param string $value
     */
    public function setLoadPlayRatio($value)
    {
        $this->setAttribute(self::load_play_ratio,$value);
    }
}
