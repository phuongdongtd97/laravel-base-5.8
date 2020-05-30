<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/23/2019
 * Time: 4:21 PM
 */

namespace App\TraitHelpers;


use Illuminate\Support\Str;

trait StringTrait
{
    public function convertToModelName($string)
    {
        return Str::studly(Str::singular($string));
    }

    public function convertToModelable($modelSlug)
    {
        return $this->makeStandardModelUrl($this->convertToModelName($modelSlug));
    }

    public function makeStandardModelUrl($modelName, $prefix = null)
    {
        return $prefix . config('app.model_url') . "\\{$modelName}";
    }

    public function convertStringToArray($result)
    {
        return is_string($result) ? json_decode($result) : $result;

    }
}
