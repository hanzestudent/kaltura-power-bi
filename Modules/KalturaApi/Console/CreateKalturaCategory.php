<?php

namespace Modules\KalturaApi\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Configuration\Entities\Configuration;
use Modules\KalturaApi\Entities\Api\Category;
use Modules\KalturaApi\Entities\Api\Pager;
use Modules\KalturaApi\Entities\KalturaCategory;

class CreateKalturaCategory extends Command
{
    /**
     *  start_date is in unix time 1352734797
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
    protected $name = 'create:kaltura:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Kaltura Category from Kaltura VPaas Api';
    /**
     * @var Category
     */
    private $category;
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
     * @param Category $category
     * @param Pager $pager
     * @param Configuration $configuration
     */
    public function __construct(
        Category $category,
        Pager $pager,
        Configuration $configuration
    )
    {
        parent::__construct();
        $this->category = $category;
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
        $pageIndex = 0;
        $lastCategorySync = $this->configuration->getConfiguration('last_category_sync');
        $this->category->setCreatedAtGreaterThanOrEqual($lastCategorySync->value);
        for ($i = 0; $i < self::MAX_ROWS; $i = $i + $this->pager->getPageSize()) {
            $pageIndex++;
            $this->pager->setPageIndex($pageIndex);
            $response = $this->category->list(
                $this->category->getCategoryFilter(),
                $this->pager->getFilterPager()
            );
            if ($response) {
                foreach ($response->objects as $category) {
                    $kalturaCategoryExists = KalturaCategory::find($category->id);
                    if (!$kalturaCategoryExists) {
                        $kalturaCategory = new KalturaCategory();
                        $kalturaCategory->kaltura_category_id = $category->id;
                        $kalturaCategory->parent_id = $category->parentId;
                        $kalturaCategory->depth = $category->depth;
                        $kalturaCategory->name = $category->name;
                        if(strpos($category->name,'.') !== false) {
                            $nameStr = explode('.',$category->name);
                            $kalturaCategory->education_code = $nameStr[0];
                        }
                        $kalturaCategory->full_ids = $category->fullIds;
                        $kalturaCategory->owner = $category->owner;
                        $kalturaCategory->status = $category->status;
                        $kalturaCategory->setCreatedAt(date("Y-m-d H:i:s", $category->createdAt));
                        $kalturaCategory->setUpdatedAt(date("Y-m-d H:i:s", $category->updatedAt));
                        try {
                            $kalturaCategory->save();
                        } catch (Exception $e){
                            Log::warning('Category '. $category->id . 'Could not be added');
                            var_dump($e);
                            die;
                        }
                    }
                    $lastCategorySync->value = $category->createdAt;
                    $lastCategorySync->save();
                }
            }
        }
    }
}
