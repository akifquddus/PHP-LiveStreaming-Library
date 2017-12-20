<?php
/**
 * Copyright (c) 2017. Sohail Haider, Averox Inc.
 * @author Sohail Haider <sohailh343@gmail.com>
 */

use Symfony\Component\Process\Process;

/**
 * Class Streams_model
 * Not being Used right now, but will be used in case CACHE goes out.
 */
class Streams_model extends CI_Model {
    /**
     * Variable used to store information Statically
     * @var array $persistentData
     */
    public static $persistentData = array();

    /**
     * Will Store infromation provded on given key.
     * NOTE: key is OPTIONAL
     * @param $obj
     * @param string $key
     */
    public static function set ($obj, $key='') {
        if($key == '') {
            array_push(self::$persistentData, $obj);
        } else {
            self::$persistentData[$key] = $obj;
        }
    }

    /**
     * Will return all stored information - OUTDATED
     * @return array
     */
    public static function getAll() {
        return self::$persistentData;
    }

    /**
     * Will return any Data stored at provided key
     * @param $key
     * @return mixed
     */
    public static function get($key) {
        return self::$persistentData[$key];
    }

    /**
     * Will remove stored static data.
     * @param $key
     */
    public static function remove($key) {
        unset(self::$persistentData[$key]);
    }

    /**
     * Clear All Static Data
     */
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