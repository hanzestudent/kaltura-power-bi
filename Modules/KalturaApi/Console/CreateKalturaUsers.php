<?php

namespace Modules\KalturaApi\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Configuration\Entities\Configuration;
use Modules\KalturaApi\Entities\KalturaUser;
use Modules\KalturaApi\Entities\Api\Pager;
use Modules\KalturaApi\Entities\Api\User;

class CreateKalturaUsers extends Command
{
    /**
     * This indicated how many rows Kaltura can max show
     *
     * ATTENTION: 10000 is max that can be retrieved
     *
     * @var integer
     */
    const MAX_ROWS = 10000;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:kaltura:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Kaltura Users from Kaltura VPaas Api';
    /**
     * @var Pager
     */
    private $pager;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * Create a new command instance.
     *
     * @param User $user
     * @param Pager $pager
     * @param Configuration $configuration
     */
    public function __construct(
        User $user,
        Pager $pager,
        Configuration $configuration
    )
    {
        parent::__construct();
        $this->pager = $pager;
        $this->user = $user;
        $this->configuration = $configuration;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $pageIndex = 0;
        $lastUserSync = $this->configuration->getConfiguration('last_user_sync');
        $this->user->setCreatedAtGreaterThanOrEqual($lastUserSync->value);
        for ($i = 0; $i < self::MAX_ROWS; $i = $i + $this->pager->getPageSize()) {
            $pageIndex++;
            $this->pager->setPageIndex($pageIndex);
            $response = $this->user->list(
                $this->user->getUserFilter(),
                $this->pager->getFilterPager()
            );
            if ($response) {
                foreach ($response->objects as $user) {
                    $kalturaUserExists = KalturaUser::find($user->id);
                    if (!$kalturaUserExists) {
                        $kalturaUser = new KalturaUser();
                        $kalturaUser->kaltura_user_id = $user->id;
                        $kalturaUser->status = $user->status;
                        $kalturaUser->setCreatedAt(date("Y-m-d H:i:s", $user->createdAt));
                        $kalturaUser->setUpdatedAt(date("Y-m-d H:i:s", $user->updatedAt));
                        try {
                            $kalturaUser->save();
                        } catch (\Exception $e){
                            Log::warning('User'. $user->id . 'Could not be added');
                            var_dump($e);
                            die;
                        }
                    }
                }
                $lastUserSync->value = $user->createdAt;
                $lastUserSync->save();
            }
        }
    }
}
