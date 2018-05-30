<?php

namespace Modules\Datawarehouse\Console;

use Illuminate\Console\Command;
use Modules\Datawarehouse\Entities\DwUsersEducation;
use Modules\Datawarehouse\Entities\Load\UsersEducation;
use Modules\Datawarehouse\Entities\Transformation\TCategories;
use Modules\Datawarehouse\Entities\Transformation\TCategoryEntries;
use Modules\Datawarehouse\Entities\Transformation\TCourses;
use Modules\Datawarehouse\Entities\Transformation\TEducation;
use Modules\Datawarehouse\Entities\Transformation\TMedia;
use Modules\Datawarehouse\Entities\Transformation\TRecordings;
use Modules\Datawarehouse\Entities\Transformation\TUsers;
use Modules\Datawarehouse\Entities\DwCategory;
use Modules\Datawarehouse\Entities\DwCategoryEntry;
use Modules\Datawarehouse\Entities\DwCourse;
use Modules\Datawarehouse\Entities\DwEducation;
use Modules\Datawarehouse\Entities\DwMedia;
use Modules\Datawarehouse\Entities\DwRecording;
use Modules\Datawarehouse\Entities\DwUser;
use Modules\Datawarehouse\Entities\DwViews;
use Modules\Datawarehouse\Entities\Transformation\TView;

class ActivateEtlProces extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'activate:etlProces:now';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transform data and load into database';
    /**
     * @var DwCategory
     */
    private $dwCategory;
    /**
     * @var DwCategoryEntry
     */
    private $dwCategoryEntry;
    /**
     * @var DwCourse
     */
    private $dwCourse;
    /**
     * @var DwEducation
     */
    private $dwEducation;
    /**
     * @var DwMedia
     */
    private $dwMedia;
    /**
     * @var DwRecording
     */
    private $dwRecording;
    /**
     * @var DwUser
     */
    private $dwUser;
    /**
     * @var DwViews
     */
    private $dwViews;
    /**
     * @var TUsers
     */
    private $tUsers;
    /**
     * @var TEducation
     */
    private $tEducation;
    /**
     * @var TCourses
     */
    private $tCourses;
    /**
     * @var TCategories
     */
    private $tCategories;
    /**
     * @var TRecordings
     */
    private $tRecordings;
    /**
     * @var TMedia
     */
    private $tMedia;
    /**
     * @var TCategoryEntries
     */
    private $tCategoryEntries;
    /**
     * @var TView
     */
    private $tView;
    /**
     * @var UsersEducation
     */
    private $lUsersEducation;
    /**
     * @var DwUsersEducation
     */
    private $dwUsersEducation;


    /**
     * Create a new command instance.
     *
     * @param DwCategory $dwCategory
     * @param DwCategoryEntry $dwCategoryEntry
     * @param DwCourse $dwCourse
     * @param DwEducation $dwEducation
     * @param DwMedia $dwMedia
     * @param DwRecording $dwRecording
     * @param DwUser $dwUser
     * @param DwViews $dwViews
     * @param DwUsersEducation $dwUsersEducation
     * @param TUsers $tUsers
     * @param TEducation $tEducation
     * @param TCourses $tCourses
     * @param TCategories $tCategories
     * @param TRecordings $tRecordings
     * @param TMedia $tMedia
     * @param TCategoryEntries $tCategoryEntries
     * @param TView $tView
     * @param UsersEducation $lUsersEducation
     */
    public function __construct(
        DwCategory $dwCategory,
        DwCategoryEntry $dwCategoryEntry,
        DwCourse $dwCourse,
        DwEducation $dwEducation,
        DwMedia $dwMedia,
        DwRecording $dwRecording,
        DwUser $dwUser,
        DwViews $dwViews,
        DwUsersEducation $dwUsersEducation,
        TUsers $tUsers,
        TEducation $tEducation,
        TCourses $tCourses,
        TCategories $tCategories,
        TRecordings $tRecordings,
        TMedia $tMedia,
        TCategoryEntries $tCategoryEntries,
        TView $tView,
        UsersEducation $lUsersEducation
    )
    {
        parent::__construct();

        $this->dwCategory = $dwCategory;
        $this->dwCategoryEntry = $dwCategoryEntry;
        $this->dwCourse = $dwCourse;
        $this->dwEducation = $dwEducation;
        $this->dwMedia = $dwMedia;
        $this->dwRecording = $dwRecording;
        $this->dwUser = $dwUser;
        $this->dwViews = $dwViews;
        $this->dwUsersEducation = $dwUsersEducation;

        $this->tUsers = $tUsers;
        $this->tEducation = $tEducation;
        $this->tCourses = $tCourses;
        $this->tCategories = $tCategories;
        $this->tRecordings = $tRecordings;
        $this->tMedia = $tMedia;
        $this->tCategoryEntries = $tCategoryEntries;
        $this->tView = $tView;

        $this->lUsersEducation = $lUsersEducation;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->deleteAllInDataWarehouse();
        //$this->tUsers->transformUsers();
        //$this->tEducation->transformEducation();
        $this->lUsersEducation->importUsersEducation();
        //$this->tCourses->transformCourses();
        //$this->tCategories->transformCategories();
        //$this->tRecordings->transformRecordings();
        //$this->tMedia->transformMedia();
        //$this->tCategoryEntries->transformCategoryEntries();
        //$this->tView->transformViews();
    }

    /**
     * Delete all rows in data warehouse
     */
    public function deleteAllInDataWarehouse() {
        //$this->dwViews->deleteAll();
        //$this->dwCategoryEntry->deleteAll();
        //$this->dwMedia->deleteAll();
        //$this->dwCategory->deleteAll();
        //$this->dwCourse->deleteAll();
        $this->dwUsersEducation->deleteAll();
        //$this->dwEducation->deleteAll();
        //$this->dwRecording->deleteAll();
        //$this->dwUser->deleteAll();
    }
}
