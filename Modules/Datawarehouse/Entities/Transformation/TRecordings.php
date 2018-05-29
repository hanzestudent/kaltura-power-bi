<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 28-5-2018
 * Time: 14:42
 */

namespace Modules\Datawarehouse\Entities\Transformation;


use DateTime;
use Exception;
use Modules\Datawarehouse\Entities\DwRecording;
use Modules\Datawarehouse\Entities\DwUser;
use Modules\Datawarehouse\Helpers\Anonymize;
use Modules\Presentations2Go\Entities\Recording;
use Modules\Digirooster\Entities\Digirooster;

class TRecordings
{
    /**
     * @var recording
     */
    private $recording;
    /**
     * @var Anonymize
     */
    private $anonymize;

    /**
     * TRecordings constructor.
     * @param recording $recording
     * @param Anonymize $anonymize
     */
    public function __construct(
        Recording $recording,
        Anonymize $anonymize
    )
    {
        $this->recording = $recording;
        $this->anonymize = $anonymize;
    }

    /**
     *  Transform data staging area and load it into data warehouse.
     */
    public function transformRecordings() {
        $saRecordings = $this->recording->getAll();
        foreach ($saRecordings as $key => $saRecording){
            if($saRecording->getCreatorId() == 'AAAA' || $saRecording->getCreatorId() == 'ABCD' || $saRecording->getDuration() == 0) {
                continue;
            }
            var_dump($saRecording);
            /**
             * @var $saRecording Recording
             */
            $dwRecording = new DwRecording();
            $dwRecording->setTitle($saRecording->getTitle());
            $dwRecording->setDescription($saRecording->getDescription());
            $dwRecording->setTags($saRecording->getTags());
            $dwRecording->setDevice($saRecording->getDevice());
            $dwRecording->setCreatorId(
                $this->getUserId($saRecording->getCreatorId())
            );
            $dwRecording->setDuration($saRecording->getDuration());
            $dwRecording->setRecordedAt($saRecording->getRecordedAt());

            $dwRecording = $this->matchDigirooster($dwRecording, $saRecording);
            try {
                $dwRecording->save();
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }

    /**
     * Check if user exists
     *
     * @param string $creatorId
     * @return mixed|null
     */
    public function getUserId($creatorId) {
        /**
         * @var $dwUser DwUser
         */
        $dwUser = DwUser::query()->where(
            DwUser::id,$this->anonymize->anonymizeUser($creatorId)
        )->first();
        if ($dwUser) {
            return $dwUser->id;
        }
        return null;
    }

    /**
     * Match a Digirooster with a recording.
     *
     * @param DwRecording $dwRecording
     * @param Recording $saRecording
     * @return DwRecording
     */
    public function matchDigirooster($dwRecording,$saRecording) {
        if($this->getDate($saRecording->getRecordedAt(),'Y-m-d','Y-m-d H:i:s') >= '2018-01-01') {
            $saDigirooster = Digirooster::query()->select([
                    Digirooster::object_id,
                    Digirooster::name,
                    Digirooster::type,
                    Digirooster::location,
                    Digirooster::start_time_full,
                    Digirooster::end_time_full
                ])
                ->where(Digirooster::speaker_id, $saRecording->getCreatorId())
                ->whereDate(Digirooster::start_time_full, '=', $this->getDate($saRecording->getRecordedAt(),'Y-m-d','Y-m-d H:i:s'))
                ->whereRaw("'".$this->getDate($saRecording->getRecordedAt(),'H:i:s','Y-m-d H:i:s')."' BETWEEN subtime(" . Digirooster::start_time . ",\"3:0:0\") AND " . Digirooster::end_time);
            if(array_key_exists($saRecording->getDevice(),$this->getLocationOfRecordSet())) {
                $locations = $this->getLocationOfRecordSet();
                $saDigirooster->where(Digirooster::location,'like', '%'.$locations[$saRecording->getDevice()].'%');
            }
            $saDigirooster->groupBy([
                Digirooster::object_id,
                    Digirooster::name,
                    Digirooster::type,
                    Digirooster::location,
                    Digirooster::start_time_full,
                    Digirooster::end_time_full
                ]);
            $match = $saDigirooster->first();
            /**
             * @var $match Digirooster
             */
            if($match) {
                $dwRecording->setObjectId($match->getObjectId());
                $dwRecording->setName($match->getName());
                $dwRecording->setType($match->getType());
                $dwRecording->setLocation($match->getLocation());
                $dwRecording->setStartTimeFull($match->getStartTimeFull());
                $dwRecording->setEndTimeFull($match->getEndTimeFull());
            }
        }
        return $dwRecording;
    }

    /**
     * All locations
     *
     * @return array
     */
    public function getLocationOfRecordSet() {
        return [
            'ZP17_Auditorium' => 'ZP17',
            'ZP07_I201' => 'I201',
            'ZP09_D232' => 'D232',
            'ZP11_Auditorium' => 'ZP11',
            'ZP23_C003' => 'C003',
            'WBC_B111' => 'B111',
            'WBC_B118' => 'B118',
            'WBC_B157' => 'B157'
        ];
    }

    /**
     * get Date in different values
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