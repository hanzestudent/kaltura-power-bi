<?php
/**
 * Created by PhpStorm.
 * User: 275335
 * Date: 28-5-2018
 * Time: 11:40
 */

namespace Modules\Datawarehouse\Entities\Transformation;


use Exception;
use Modules\Blackboard\Entities\Education;
use Modules\Datawarehouse\Entities\DwEducation;

class TEducation
{
    /**
     * @var Education
     */
    private $education;

    /**
     * TEducation constructor.
     * @param Education $education
     */
    public function __construct(
        Education $education
    )
    {
        $this->education = $education;
    }

    /**
     *
     */
    public function transformEducation() {
        $saEducations = $this->education->getAll();
        foreach ($saEducations as $key => $saEducation){
            /**
             * @var $saEducation Education
             */
            $dwEducation = new DwEducation();
            $dwEducation->setEducationCode($saEducation->getEducationCode());
            $dwEducation->setType($saEducation->getType());
            $dwEducation->setEducation($saEducation->getEducation());
            $dwEducation->setSchool($saEducation->getSchool());
            $dwEducation->setName($saEducation->getName());
            try{
                $dwEducation->save();
            } catch (Exception $e) {
                var_dump($e->getMessage());
                die;
            }
        };
    }
}