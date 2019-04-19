<?php
/**
 * Created by PhpStorm.
 * User: netatlas
 * Date: 2019-03-11
 * Time: 09:50
 */

namespace App\Tool;


class DotNotationCollection
{
    public static function explode(array $source): array {
        $results = [];
        foreach($source as $label => $value) {
            $dots = explode(".", $label);
            if(count($dots) > 1) {
                $last = &$results[ $dots[0] ];
            
                foreach($dots as $k => $dot) {
                    if($k == 0) continue;
                    $last = &$last[$dot];
                }
            
                $last = $value;
            } else {
                $results[$label] = $value;
            }
        }
        return $results;
    }
}