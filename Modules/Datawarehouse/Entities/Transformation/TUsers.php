<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 28-5-2018
 * Time: 09:54
 */

namespace Modules\Datawarehouse\Entities\Transformation;


use Exception;
use Modules\Datawarehouse\Entities\DwUser;
use Modules\Datawarehouse\Helpers\Anonymize;
use Modules\KalturaApi\Entities\KalturaUser;

class TUsers
{
    /**
     * @var KalturaUser
     */
    private $kalturaUser;
    /**
     * @var DwUser
     */
    private $dwUser;
    /**
     * @var Anonymize
     */
    private $anonymize;

    /**
     * Users constructor.
     * @param KalturaUser $kalturaUser
     * @param DwUser $dwUser
     * @param Anonymize $anonymize
     */
    public function __construct(
        KalturaUser $kalturaUser,
        DwUser $dwUser,
        Anonymize $anonymize
    )
    {
        $this->kalturaUser = $kalturaUser;
        $this->dwUser = $dwUser;
        $this->anonymize = $anonymize;
    }

    /**
     * Transform data and anonymize data then import it into data warehouse
     */
    public function transformUsers() {
        $saUsers = $this->kalturaUser->getAll();
        foreach ($saUsers as $key => $saUser){
            /**
             * @var $saUser KalturaUser
             */
            $dwUser = new DwUser();
            $dwUser->setId(
                $this->anonymize->anonymizeUser($saUser->getKalturaUserId())
            );
            $dwUser->setType(
                $this->typeOfUser($saUser->getKalturaUserId())
            );
            $dwUser->setCreatedAt($saUser->created_at);
            $dwUser->setUpdatedAt($saUser->updated_at);
            try{
                $dwUser->save();
            } catch (Exception $e) {
                var_dump($e->getMessage());
                die;
            }
        };
    }

    /**
     * What type of user is it.
     *
     * @param $userId string
     * @return string
     */
    public function typeOfUser($userId) {
        if(preg_match('/^[0-9]{6}$/',$userId)) {
            $type = 'student';
        } elseif (preg_match('/^[A-Za-z]{4}$/',$userId)) {
            $type = 'employee';
        } elseif (preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$userId)) {
            $type = 'emailAddress';
        } elseif (preg_match('/\w*assignment\b/', $userId)) {
            $type = 'assignments';
        } else {
            $type = 'unknown';
        }
        return $type;
    }
}