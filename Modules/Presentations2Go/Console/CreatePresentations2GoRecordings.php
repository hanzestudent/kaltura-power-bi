<?php

namespace Modules\Presentations2Go\Console;

use DateTime;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Configuration\Entities\Configuration;
use Modules\Presentations2Go\Entities\recording;

class CreatePresentations2GoRecordings extends Command
{
    const presentations2goMaps = [
        'ZP17_Auditorium',
        'ZP07_I201',
        'ZP09_D232',
        'ZP11_Auditorium',
        'ZP23_C003',
        'WBC_B111',
        'WBC_B118',
        'WBC_B157',
        'MobieleSet_ZP11',
        'MobieleSet_ZP17'
    ];

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'presentations2go:import:recordings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import recordings from metadata Presentations2Go.';
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var Configuration
     */
    private $presentations2goLastSynced;

    /**
     * Create a new command instance.
     *
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        parent::__construct();
        $this->configuration = $configuration;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * if a server has been added add the map of that server to the constant
         */
        $dirModule = dirname(__DIR__);
        $dirModuleXml = $dirModule.DIRECTORY_SEPARATOR."Xml";
        foreach (self::presentations2goMaps as $presentations2goMap) {
            $this->presentations2goLastSynced = $this->configuration->getConfiguration($presentations2goMap);
            if(!$this->presentations2goLastSynced) {
                $configuration = new Configuration();
                $configuration->path = $presentations2goMap;
                $configuration->value = date('Y-m-d',1352734799);
                try {
                    $configuration->save();
                } catch (Exception $e) {
                    Log::warning('configuration could not be added');
                    var_dump($e->getMessage());
                    return false;
                }
                $this->presentations2goLastSynced = $configuration;
            }
            /**
             * Look if map in constant exists
             */
            if(file_exists($dirModuleXml.DIRECTORY_SEPARATOR.$presentations2goMap)) {
                $recordingsYear = $dirModuleXml.DIRECTORY_SEPARATOR.$presentations2goMap;
                /**
                 * Get all maps in directory and loop through years
                 */
                $years = array_diff(scandir($recordingsYear), array('..', '.'));
                foreach ($years as $year) {
                    if($year < $this->getDate($this->presentations2goLastSynced->value,'Y')) {
                        continue;
                    }
                    $recordingsMonths = $recordingsYear.DIRECTORY_SEPARATOR.$year;
                    /**
                     * Get all maps in directory and loop through months
                     */
                    $months = array_diff(scandir($recordingsMonths), array('..', '.'));
                    foreach ($months as $month)  {
                        if( $year == $this->getDate($this->presentations2goLastSynced->value,'Y') &&
                        $month < $this->getDate($this->presentations2goLastSynced->value,'m')
                        ) {
                            continue;
                        }
                        $recordingDays = $recordingsMonths.DIRECTORY_SEPARATOR.$month;
                        /**
                         * Get all maps in directory and loop through days
                         */
                        $days = array_diff(scandir($recordingDays), array('..', '.'));
                        foreach ($days as $day) {
                            if( $year == $this->getDate($this->presentations2goLastSynced->value,'Y') &&
                                $month == $this->getDate($this->presentations2goLastSynced->value,'m') &&
                                $day < $this->getDate($this->presentations2goLastSynced->value,'d')
                            ) {
                                continue;
                            }
                            $recordingsOnDay = $recordingDays.DIRECTORY_SEPARATOR.$day;
                            $x = 1;
                            /**
                             * Get all maps if through loop further
                             */
                            while(
                                file_exists($recordingsOnDay.DIRECTORY_SEPARATOR.$x.DIRECTORY_SEPARATOR."recordingdetails.xml")
                            ) {
                                $recordingOnDay = simplexml_load_file($recordingsOnDay.DIRECTORY_SEPARATOR.$x.DIRECTORY_SEPARATOR."recordingdetails.xml");
                                $added = $this->saveXmlToRecordings($recordingOnDay, $year.'-'.$month.'-'.$day, $presentations2goMap);
                                if(!$added) {
                                    die;
                                }
                                $x++;
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Save xml into table recordings
     *
     * @param $xml
     * @param $dateOfMap
     * @param $presentations2goMap
     * @return bool
     */
    public function saveXmlToRecordings($xml,$dateOfMap,$presentations2goMap) {
        if(isset($xml->p2gRecord)) {
            $presentations2Go = $xml->p2gRecord;
            $author = $presentations2Go->contributors->contributor->name;
            $startTime = str_replace('T',' ',$presentations2Go->startTime);
            $recording = new Recording();
            $recording->title = $presentations2Go->title;
            $recording->description = $presentations2Go->location;
            $recording->tags = $presentations2Go->keywords;
            $recording->creator_id = $author;
            $recording->duration = $presentations2Go->duration;
            $recording->recorded_at = $startTime;
            $recording->device = $presentations2goMap;
            try {
                $recording->save();
            } catch (Exception $e) {
                Log::warning('media '. $recording->title . 'Could not be added');
                var_dump($e->getMessage());
                return false;
            }
        } else {
            $presentations2Go = $xml->metadata;
            $firstArray = $presentations2Go[0];
            $secondArray = $presentations2Go[1];
            if(
                isset($secondArray->attribute[0])
                && is_int((int)$secondArray->attribute[0])
                && strlen($secondArray->attribute[1]) ==4 ||
                isset($secondArray->attribute[0])
                && is_int((int)$secondArray->attribute[0])
                && strlen($secondArray->attribute[1]) ==3
            ) {
                if(isset($secondArray->attribute[3])) {
                    $isItADate = DateTime::createFromFormat('Y-m-d H:i:s', str_replace('T', ' ', $secondArray->attribute[3]));
                    if($isItADate) {
                        $startTime = str_replace('T', ' ', $secondArray->attribute[3]);
                    } else {
                        $startTime = str_replace('T', ' ', $secondArray->attribute[2]);
                    }
                } else {
                    $startTime = str_replace('T', ' ', $secondArray->attribute[2]);
                }
                $recording = new Recording();
                $recording->title = $firstArray->attribute[0];
                $recording->description = $firstArray->attribute[1];
                $recording->tags = isset($firstArray->attribute[2]) ? $firstArray->attribute[2] : '';
                $recording->creator_id = $secondArray->attribute[1];
                $recording->duration = $secondArray->attribute[0];
                $recording->recorded_at = $startTime;
                $recording->device = $presentations2goMap;
            } else {
                $recording = new Recording();
                $recording->title = $secondArray->attribute[0];
                $recording->description = $secondArray->attribute[1];
                $recording->tags = isset($secondArray->attribute[2]) ? $secondArray->attribute[2] : '';
                $recording->device = $presentations2goMap;
                if(strlen($firstArray->attribute[0]) == 4) {
                    $startTime = str_replace('T', ' ', $firstArray->attribute[3]);
                    $recording->creator_id = $firstArray->attribute[0];
                    $recording->duration = $firstArray->attribute[2];
                    $recording->recorded_at = $startTime;
                } else {
                    $startTime = str_replace('T', ' ', $firstArray->attribute[2]);
                    $recording->creator_id = $firstArray->attribute[3];
                    $recording->duration = $firstArray->attribute[1];
                    $recording->recorded_at = $startTime;
                }

            }
            try {
                $recording->save();
            } catch (Exception $e) {
                Log::warning('media '. $recording->title . 'Could not be added');
                var_dump($e->getMessage());
                return false;
            }
        }
        $this->presentations2goLastSynced->value = $this->getDate($dateOfMap,'Y-m-d');
        try {
            $this->presentations2goLastSynced->save();
        } catch (Exception $e) {
            Log::warning('configuration could not be added');
            var_dump($e->getMessage());
            return false;
        }
        return true;
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
