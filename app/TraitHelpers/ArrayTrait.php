<?php


namespace App\TraitHelpers;


trait ArrayTrait
{
    public function convertToArray($result)
    {
        if (is_string($result)) {
            return json_decode($result, true);
        }
        if (is_object($result)) {
            return json_decode(json_encode($result), true);
        }
        return $result;

    }

    public function getOnly($array, $keys)
    {
        return collect($array)->only($keys)->toArray();
    }

    public function convertArrayToObject($array)
    {
        return json_decode(json_encode($array));
    }
}
