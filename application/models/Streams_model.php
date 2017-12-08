<?php

use Symfony\Component\Process\Process;
class Streams_model extends CI_Model {
    public static $persistentData = [];

    public static function set ($obj, $key='') {
        if($key == '') {
            array_push(self::$persistentData, $obj);
        } else {
            self::$persistentData[$key] = $obj;
        }
    }

    public static function getAll() {
        return self::$persistentData;
    }

    public static function get($key) {
        return self::$persistentData[$key];
    }

    public static function remove($key) {
        unset(self::$persistentData[$key]);
    }

    public static function cleanAllProcess() {
        foreach (self::$persistentData as $key => $theProcess) {
            try {
                if(!$theProcess->isRunning()) {
                    unset(self::$persistentData[$key]);
                }
            }
            catch (Exception $exception) {
                continue;
            }
        }
    }
}