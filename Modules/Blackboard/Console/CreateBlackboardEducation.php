<?php

namespace Modules\Blackboard\Console;

use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Blackboard\Entities\Course;

class CreateBlackboardEducation extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'blackboard:import:courses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import blackboard courses. Csv name has to be blackboard.csv';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add courses from csv file
     *
     * @return mixed
     */
    public function handle()
    {
        $row = 0;
        $dirModule = dirname(__DIR__);
        if(($handle = fopen($dirModule."..\Csv\blackboard.csv", "r")) !== false) {
            while($data = fgetcsv($handle)) {
                $row++;
                if($row == 1) {
                    continue;
                }
                $course = new Course();
                $course->course_id = $data[0];
                $course->name = $data[1];
                $dtime = DateTime::createFromFormat("d-M-y", $data[2]);
                $timestamp = $dtime->getTimestamp();
                $course->created_at = date("Y-m-d", $timestamp);
                $course->number_of_enrolled_users = $data[3];
                try {
                    $course->save();
                } catch (\Exception $e){
                    Log::warning('media '. $data[0] . 'Could not be added');
                    Log::warning($e->getMessage());
                    var_dump($e->getMessage());
                    die;
                    return false;
                }
            }
        }
    }
}
