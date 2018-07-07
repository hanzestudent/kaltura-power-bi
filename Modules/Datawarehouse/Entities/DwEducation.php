<?php

namespace Modules\Datawarehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class DwEducation extends Model
{
    const id = 'education_code';
    const type = 'type';
    const education = 'education';
    const school = 'school';
    const name = 'name';

    protected $fillable = [];

    protected $table = 'dw_education';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $primaryKey = 'education_code';

    /**
     * delete all in table
     */
    public function deleteAll(){
        DwEducation::query()->delete();
    }

    /**
     * @return string
     */
    public function getEducationCode(): string
    {
        return $this->getAttribute(self::id);
    }

    /**
     * @param string $educationCode
     */
    public function setEducationCode(string $educationCode): void
    {
        $this->setAttribute(self::id,$educationCode);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->getAttribute(self::type);
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->setAttribute(self::type,$type);
    }

    /**
     * @return string
     */
    public function getEducation(): string
    {
        return $this->getAttribute(self::education);
    }

    /**
     * @param string $education
     */
    public function setEducation(string $education): void
    {
        $this->setAttribute(self::education,$education);
    }

    /**
     * @return string
     */
    public function getSchool(): string
    {
        return $this->getAttribute(self::school);
    }

    /**
     * @param string $school
     */
    public function setSchool(string $school): void
    {
        $this->setAttribute(self::school,$school);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getAttribute(self::name);
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->setAttribute(self::name,$name);
    }
}
