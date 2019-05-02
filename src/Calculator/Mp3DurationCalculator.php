<?php


namespace App\Calculator;

use wapmorgan\Mp3Info\Mp3Info;

class Mp3DurationCalculator
{
    
    /**
     * @param string $source
     * @return float|int|string
     * @throws \Exception
     */
    public static function calculate(string $source) {
        $audio = new Mp3Info($source);
    
        $duration = $audio->duration;
        $hours = floor($duration / 3600);
        $duration -= ($hours * 3600);
        $minutes = str_pad(
            floor($duration / 60),
            2,
            "0",
            STR_PAD_LEFT
        );
        $seconds = str_pad(
            floor($duration % 60),
            2,
            "0",
            STR_PAD_LEFT
        );;
        $duration = "$hours:$minutes:$seconds";
        return $duration;
    }
    
}