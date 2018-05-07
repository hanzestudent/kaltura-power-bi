<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\KalturaApi\Console\CreateKalturaCategory;
use Modules\KalturaApi\Console\CreateKalturaCategoryEntry;
use Modules\KalturaApi\Console\CreateKalturaMediaEntries;
use Modules\KalturaApi\Console\CreateKalturaUsers;
use Modules\KalturaApi\Console\CreateKalturaViews;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = array(
        CreateKalturaUsers::class,
        CreateKalturaMediaEntries::class,
        CreateKalturaCategory::class,
        CreateKalturaCategoryEntry::class,
        CreateKalturaViews::class
    );

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('create:kaltura:categoryEntry')->everyTenMinutes();
        $schedule->command('create:kaltura:views')->everyTenMinutes();
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
