<?php
/**
 * Created by PhpStorm.
 * User: yourivanlaer
 * Date: 2019-10-31
 * Time: 14:14
 */

namespace App\Helpers;

class Json
{
    /**
     * Dump data as json (add ?json to URL)
     *
     * @param mixed $data string, array, associative array object
     * @param bool $onlyInDebugMode runs only in debug mode: default = true
     * @version 1.0
     */
    public function dump($data = null, $onlyInDebugMode = true)
    {
        $show = ($onlyInDebugMode === true && env('APP_DEBUG') === false) ? false : true;
        if (array_key_exists('Json', app('request')->query()) && $show) {
            header('Content-Type: application/json');
            die(json_encode($data));
        }
    }
}