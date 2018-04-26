<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 25-4-2018
 * Time: 15:30
 */

namespace Modules\KalturaApi\Entities\Api;

use \Kaltura\Client\Client as KalturaClient;
use \Kaltura\Client\Configuration as KalturaConfiguration;
use \Modules\Configuration\Entities\Configuration;
use Kaltura\Client\Enum\SessionType;

class Client
{
    /**
     * @var string
     */
    private $partnerId = '';

    private $administratorSecret = '';

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * Client constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Create Kaltura Session to get data :)
     *
     * @return KalturaClient
     */
    public function getClient() {
        if(!$this->administratorSecret) {
            $this->administratorSecret = $this->configuration->getConfiguration('administrator_secret')->value;
        }
        if(!$this->partnerId) {
            $this->partnerId = $this->configuration->getConfiguration('partner_id')->value;
        }
        if(!$this->partnerId || !$this->administratorSecret) {
            return redirect('admin')->with('error_message',
                'Please fill in a configuration for either partner_id or administrator_secret'
            );
        }

        $client = new KalturaClient($this->getConfig());
        $ks = $client->getSessionService()->start(
            $this->administratorSecret,
            '',
            SessionType::ADMIN,
            $this->partnerId
        );

        $client->setKs($ks);

        return $client;
    }

    /**
     * Get configuration
     *
     * @return KalturaConfiguration
     */
    protected function getConfig() {
        $configuration = new KalturaConfiguration();
        $configuration->getServiceUrl();
        return $configuration;
    }

}