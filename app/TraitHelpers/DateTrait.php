<?php

namespace App\TraitHelpers;

use DateTime;


trait DateTrait
{
    public function parseDate($dateString, $inputFormat = 'd-m-Y', $outputFormat = 'Y-m-d')
    {
        try {
            return DateTime::createFromFormat($inputFormat, $dateString)->format($outputFormat);
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function handleDateToString($date, $outputFormat = 'd-m-Y')
    {
        return date($outputFormat, strtotime($date));
    }

    public function handleDefaultDatetime($value, $default, $suffixes = false)
    {
        if ($value == null)
            $value = $default;
        if ($suffixes) {
            $value = "$value $suffixes";
        }
        return $value;
    }
}
