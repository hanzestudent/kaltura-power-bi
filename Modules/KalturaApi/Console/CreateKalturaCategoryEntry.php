<?php

namespace Modules\KalturaApi\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Configuration\Entities\Configuration;
use Modules\KalturaApi\Entities\Api\CategoryEntry;
use Modules\KalturaApi\Entities\Api\Pager;
use Modules\KalturaApi\Entities\KalturaCategoryEntry;

class CreateKalturaCategoryEntry extends Command
{
    /**
     *  start_date is in unix time 1352734799
     */

    /**
     * This indicated how many rows Kaltura can max show
     *
     * @var integer
     */
    const MAX_ROWS = 10000;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:kaltura:categoryEntry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Kaltura Category entries from Kaltura VPaas Api';
    /**
     * @var CategoryEntry
     */
    private $categoryEntry;
    /**
     * @var Pager
     */
    private $pager;
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * Create a new command instance.
     *
     * @param CategoryEntry $categoryEntry
     * @param Pager $pager
     * @param Configuration $configuration
     */
    public function __construct(
        CategoryEntry $categoryEntry,
        Pager $pager,
        Configuration $configuration
    )
    {
        parent::__construct();
        $this->categoryEntry = $categoryEntry;
        $this->pager = $pager;
        $this->configuration = $configuration;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('begin category cron');
        $pageIndex = 0;
        $lastCategorySync = $this->configuration->getConfiguration('last_category_entries_sync');
        $this->categoryEntry->setCreatedAtGreaterThanOrEqual($lastCategorySync->value);
        for ($i = 0; $i < self::MAX_ROWS; $i = $i + $this->pager->getPageSize()) {
            $pageIndex++;
            $this->info('page '. $pageIndex);
            $this->pager->setPageIndex($pageIndex);
            $response = $this->categoryEntry->list(
                $this->categoryEntry->getCategoryEntryFilter(),
                $this->pager->getFilterPager()
            );
            if ($response) {
                foreach ($response->objects as $categoryEntry) {
                    $kalturaCategoryEntryExists = KalturaCategoryEntry::where('kaltura_category_id', $categoryEntry->categoryId)
                                            ->where('kaltura_media_id', $categoryEntry->entryId)->first();
                    if (!$kalturaCategoryEntryExists) {
                        $kalturaCategoryEntry = new KalturaCategoryEntry();
                        $kalturaCategoryEntry->kaltura_category_id = $categoryEntry->categoryId;
                        $kalturaCategoryEntry->kaltura_media_id = $categoryEntry->entryId;
                        $kalturaCategoryEntry->creator_user_id = $categoryEntry->creatorUserId;
                        $kalturaCategoryEntry->category_full_ids = $categoryEntry->categoryFullIds;
                        $kalturaCategoryEntry->status = $categoryEntry->status;
                        $kalturaCategoryEntry->setCreatedAt(date("Y-m-d H:i:s", $categoryEntry->createdAt));
                        try {
                            $kalturaCategoryEntry->save();
                        } catch (Exception $e){
                            Log::warning('Category '. $categoryEntry->id . 'Could not be added');
                            var_dump($e);
                            die;
                        }
                    }
                    $lastCategorySync->value = $categoryEntry->createdAt;
                    $lastCategorySync->save();
                }
            }
        }
        $this->info('end category cron');
    }
}
