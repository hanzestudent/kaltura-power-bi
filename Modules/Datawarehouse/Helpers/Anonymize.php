<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 25-5-2018
 * Time: 16:36
 */

namespace Modules\Datawarehouse\Helpers;

/**
 * Class to anonymize user data
 *
 * Class Anonymize
 * @package Modules\Datawarehouse\Helpers
 */
class Anonymize
{
    /**
     * anonymize user
     * @param $userId string
     * @return string
     */
    public function anonymizeUser($userId) {
        if(preg_match('/^[A-Za-z]{4}$/',$userId)) {
            $userId = strtoupper($userId);
        }
        return md5($userId);
    }
}