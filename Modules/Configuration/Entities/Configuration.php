<?php

namespace Modules\Configuration\Entities;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ["path","value"];

    /**
     * Get Configuration
     *
     * @param $path
     * @return \stdClass
     */
    public function getConfiguration($path) {
        return Configuration::where('path', $path)->first();
    }
}
