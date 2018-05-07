<?php

namespace Modules\KalturaApi\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Configuration\Entities\Configuration;
use Modules\KalturaApi\Entities\Api\Media;
use Modules\KalturaApi\Entities\Api\Pager;
use Modules\KalturaApi\Entities\KalturaMedia;

class CreateKalturaMediaEntries extends Command
{
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
    protected $name = 'create:kaltura:media';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Kaltura Media from Kaltura VPaas Api';

    /**
     * @var Media
     */
    private $media;

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
     * @param Media $media
     * @param Pager $pager
     * @param Configuration $configuration
     */
    public function __construct(
        Media $media,
        Pager $pager,
        Configuration $configuration
    )
    {
        parent::__construct();
        $this->media = $media;
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
        $lastMediaSync = $this->configuration->getConfiguration('last_media_sync');
        $this->media->setCreatedAtGreaterThanOrEqual($lastMediaSync->value);
        for ($i = 0; $i < self::MAX_ROWS; $i = $i + $this->pager->getPageSize()) {
            $pageIndex++;
            $this->pager->setPageIndex($pageIndex);
            $response = $this->media->list(
                $this->media->getMediaFilter(),
                $this->pager->getFilterPager()
            );
            if ($response) {
                foreach ($response->objects as $media) {
                    $kalturaMediaExists = KalturaMedia::find($media->id);
                    if (!$kalturaMediaExists) {
                        $kalturaMedia = new KalturaMedia();
                        $kalturaMedia->kaltura_media_id = $media->id;
                        $kalturaMedia->name = $media->name;
                        $kalturaMedia->description = $media->description;
                        $kalturaMedia->media_type = $media->mediaType;
                        $kalturaMedia->source_type = $media->sourceType;
                        $kalturaMedia->license_type = $media->licenseType;
                        $kalturaMedia->duration = $media->duration;
                        $kalturaMedia->ms_duration = $media->msDuration;
                        $kalturaMedia->kaltura_user_id = $media->userId;
                        $kalturaMedia->kaltura_creator_id = $media->creatorId;
                        $kalturaMedia->tags = $media->tags;
                        $kalturaMedia->status = $media->status;
                        $kalturaMedia->moderation_status = $media->moderationStatus;
                        $kalturaMedia->replacement_status = $media->replacementStatus;
                        $kalturaMedia->root_entry_id = $media->rootEntryId;
                        $kalturaMedia->setCreatedAt(date("Y-m-d H:i:s", $media->createdAt));
                        $kalturaMedia->setUpdatedAt(date("Y-m-d H:i:s", $media->updatedAt));
                        try {
                            $kalturaMedia->save();
                        } catch (Exception $e){
                            Log::warning('Media '. $media->id . 'Could not be added');
                             var_dump($e);
                            die;
                        }
                    }
                    $lastMediaSync->value = $media->createdAt;
                    $lastMediaSync->save();
                }
            }
        }
    }
}
