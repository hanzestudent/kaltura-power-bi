<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 28-5-2018
 * Time: 14:15
 */

namespace Modules\Datawarehouse\Entities\Transformation;


use DateTime;
use Exception;
use Modules\Datawarehouse\Entities\DwMedia;
use Modules\Datawarehouse\Entities\DwRecording;
use Modules\Datawarehouse\Entities\DwUser;
use Modules\Datawarehouse\Helpers\Anonymize;
use Modules\KalturaApi\Entities\KalturaMedia;

class TMedia
{
    /**
     * @var KalturaMedia
     */
    private $media;
    /**
     * @var Anonymize
     */
    private $anonymize;

    /**
     * TMedia constructor.
     * @param KalturaMedia $media
     * @param Anonymize $anonymize
     */
    public function __construct(
        KalturaMedia $media,
        Anonymize $anonymize
    )
    {
        $this->media = $media;
        $this->anonymize = $anonymize;
    }

    /**
     *  Transform data and import them in data warehouse
     */
    public function transformMedia() {
        $saMedias = $this->media->getAll();
        foreach ($saMedias as $key => $saMedia){
            /**
             * @var $saMedia KalturaMedia
             */
            if($saMedia->getMediaType() == 2) {
                continue;
            }
            $dwMedia = new DwMedia();
            $dwMedia->setId($saMedia->getId());
            $dwMedia->setRecordingId($this->getRecording($saMedia));
            $dwMedia->setName($saMedia->getName());
            $dwMedia->setDescription($saMedia->getDescription());
            $dwMedia->setMediaType($saMedia->getMediaType());
            $dwMedia->setSourceType($saMedia->getSourceType());
            $dwMedia->setDuration($saMedia->getDuration());
            $dwMedia->setMsDuration($saMedia->getMsDuration());
            $dwMedia->setUserId(
                $this->getUserId($saMedia->getUserId())
            );
            $dwMedia->setCreatorId(
                $this->getUserId($saMedia->getCreatorId())
            );
            $dwMedia->setTags($saMedia->getTags());
            $dwMedia->setModerationStatus($saMedia->getModerationStatus());
            $dwMedia->setReplacementStatus($saMedia->getReplacementStatus());
            $dwMedia->setRootEntryId($saMedia->getRootEntryId());
            $dwMedia->setCreatedAt($saMedia->getCreatedAt());
            $dwMedia->setUpdatedAt($saMedia->getUpdatedAt());
            try{
                $dwMedia->save();
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }

    /**
     * @param KalturaMedia $saMedia
     * @return int
     */
    public function getRecording($saMedia) {
        $recording = DwRecording::query()
            ->where([
                [DwRecording::title, '=',$saMedia->getName()],
                [DwRecording::duration,'=',round($saMedia->getDuration()/60)],
                [DwRecording::creator_id, '=', $this->anonymize->anonymizeUser($saMedia->getCreatorId())],
                [DwRecording::tags,'=',$saMedia->getTags()],
                [DwRecording::description, '=', $saMedia->getDescription()]
            ])
            ->orWhere([
                [DwRecording::duration,'=',round($saMedia->getDuration()/60)],
                [DwRecording::creator_id, '=', $this->anonymize->anonymizeUser($saMedia->getCreatorId())],
                [DwRecording::tags,'=',$saMedia->getTags()],
                [DwRecording::description, '=', $saMedia->getDescription()]
            ])
            ->whereDate(DwRecording::recorded_at, '=', $this->getDate($saMedia->getCreatedAt(),'Y-m-d','Y-m-d H:i:s'))
            ->first();
        if($recording) {
            return $recording->getId();
        }
        return null;
    }


    /**
     * Check if user exists
     *
     * @param string $userId
     * @return mixed|null
     */
    public function getUserId($userId) {
        /**
         * @var $dwUser DwUser
         */
        $dwUser = DwUser::query()->where(
            DwUser::id,$this->anonymize->anonymizeUser($userId)
        )->first();
        if ($dwUser) {
            return $dwUser->id;
        }
        return null;
    }

    /**
     * get Date in different values
     *
     * @param $date
     * @param $newFormat
     * @param string $oldFormat
     * @return false|string
     */
    public function getDate($date, $newFormat, $oldFormat = "Y-m-d") {
        $dtime = DateTime::createFromFormat($oldFormat, $date);
        $timestamp = $dtime->getTimestamp();
        return date($newFormat,$timestamp);
    }
}