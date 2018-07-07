<?php

namespace Modules\Datawarehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class DwUser extends Model
{
    /**
     * @var string
     */
    const id = 'id';

    /**
     * @var string
     */
    const type = 'type';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * DwUser constructor.
     */
    public function __construct(
    )
    {
        parent::__construct();
    }

    /**
     * delete all in table
     */
    public function deleteAll(){
        DwUser::query()->delete();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->getAttribute(self::id);
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->setAttribute(self::id,$id);
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
}
