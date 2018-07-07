<?php

namespace Modules\Datawarehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class DwUsersEducation extends Model
{
    const id = 'id';
    const user_id = 'user_id';
    const education_code = 'education_code';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [];

    protected $table = 'dw_users_education';

    /**
     * delete all in table
     */
    public function deleteAll(){
        DwUsersEducation::query()->delete();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getAttribute(self::id);
    }

    /**
     * @param string $value
     */
    public function setId($value)
    {
        $this->setAttribute(self::id,$value);
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->getAttribute(self::user_id);
    }

    /**
     * @param string $value
     */
    public function setUserId($value)
    {
        $this->setAttribute(self::user_id,$value);
    }

    /**
     * @return string
     */
    public function getEducationCode()
    {
        return $this->getAttribute(self::education_code);
    }

    /**
     * @param string $value
     */
    public function setEducationCode($value)
    {
        $this->setAttribute(self::education_code,$value);
    }
}
