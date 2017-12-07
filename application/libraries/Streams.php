<?php

class Streams {
    public static $persistentData = [];

    public static function set ($obj, $key='') {
        if($key == '') {
            array_push(Streams::$persistentData, $obj);
        } else {
            Streams::$persistentData[$key] = $obj;
        }
    }
}