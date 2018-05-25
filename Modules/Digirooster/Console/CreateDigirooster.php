<?php

namespace Modules\Digirooster\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Digirooster\Entities\Digirooster;

class CreateDigirooster extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'digirooster:import:roosters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will import the csv that has been received from functional admin digirooster';

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
     * Execute the console command.
     *
     * File of digirooster has to be called digirooster.csv
     *
     * @return mixed
     */
    public function handle()
    {
        $row = 0;
        $dirModule = dirname(__DIR__);
        if(($handle = fopen($dirModule."..\Csv\digirooster.csv", "r")) !== false) {
            while($data = fgetcsv($handle,0,';')) {
                $row++;
                $digirooster = new Digirooster();
                $digirooster->object_id = $data[0];
                $digirooster->name = $data[1];
                $digirooster->type = $data[2];
                $digirooster->location = $data[3];
                $digirooster->speaker_id = $data[4];
                $digirooster->class_id = $data[5];
                $digirooster->start_time_full = str_replace('.000','',$data[6]);
                $digirooster->end_time_full = str_replace('.000','',$data[7]);
                $digirooster->start_date = $data[8];
                $digirooster->start_time = $data[9];
                $digirooster->end_date = $data[10];
                $digirooster->end_time = $data[11];

                try {
                    $digirooster->save();
                } catch (\Exception $e){
                    Log::warning('digirooster row '. $data[0] . 'Could not be added');
                    Log::warning($e->getMessage());
                    var_dump($e->getMessage());
                    die;
                    return false;
                }
            }
        }
    }
}
