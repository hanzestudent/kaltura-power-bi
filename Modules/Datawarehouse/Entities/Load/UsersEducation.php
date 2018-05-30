<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 30-5-2018
 * Time: 17:35
 */

namespace Modules\Datawarehouse\Entities\Load;


use DateTime;
use Illuminate\Support\Facades\Log;
use Modules\Datawarehouse\Entities\DwUsersEducation;
use Modules\Datawarehouse\Helpers\Anonymize;

class UsersEducation
{
    const educations =
        [
            'fyvt' => 'o.fyvt.txt',
            'hvvt' => 'o.hvvt.txt'
        ];
    /**
     * @var Anonymize
     */
    private $anonymize;

    /**
     * UsersEducation constructor.
     * @param Anonymize $anonymize
     */
    public function __construct(Anonymize $anonymize)
    {
        $this->anonymize = $anonymize;
    }

    public function importUsersEducation() {
        foreach (self::educations as $key => $value) {
            $row = 0;
            $dirModule = dirname(__DIR__);
            var_dump($dirModule);
            if(($handle = fopen($dirModule."..\..\Csv\\".$value, "r")) !== false) {
                while($data = fgetcsv($handle)) {
                    var_dump($data);
                    $row++;
                    if($row == 1) {
                        continue;
                    }
                    $usersEducations = new DwUsersEducation();
                    $usersEducations->setUserId($this->anonymize->anonymizeUser($data[0]));
                    $usersEducations->setEducationCode($key);
                    try {
                        $usersEducations->save();
                    } catch (\Exception $e){
                        Log::warning('media '. $data[0] . 'Could not be added');
                        Log::warning($e->getMessage());
                    }
                }
            }
        }
    }
}