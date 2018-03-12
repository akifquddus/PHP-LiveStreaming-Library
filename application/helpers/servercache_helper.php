<?php

/**
 * Set the Cache Properties. Returns pointer of CI instance.
 * @return CI_Controller
 */
function loadCache() {
    $CI = & get_instance();
    $CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    return $CI;
}

/**
 * Return the Value Stored at provided KEY from Cache.
 * @param $key
 * @return mixed
 */
function getCache($key) {
    $CI = loadCache();
    return $CI->cache->get($key);
}

/**
 * Will Save the $value in Cache with provided $key.
 * @param $key
 * @param $value
 */
function saveInCache($key, $value) {

    $CI = loadCache();
    $CI->cache->save($key, $value, 90000);
}

/**
 * Save Process ID in PIDs Array in Cache with current time.
 * @param $PID
 */
function saveProcess($PID) {
    $CI = loadCache();
    if ( ! $processes = $CI->cache->get('processes'))
    {
        $processes = array();
    }
    $processes[$PID] = time();
    $CI->cache->save('processes', $processes, 90000);
}

/**
 * Clean all PID's older than one day,
 * wil try to kill process before removing the record.
 */
function CACHE_CLEAN_ALL() {
    $CI = loadCache();
    //Loading Helper for kill command
    $CI->load->helper('ffmpeg');
    $processes = $CI->cache->get('processes');
    if($processes && is_array($processes)) {
        foreach ($processes as $pid => $time) {
            $yesterday = strtotime('-1 days', time());
            echo " ".$pid."<br/>";
           if($yesterday > $time) { //if application been more than 24 hours

               FFMPEG_KILL_PROCESS($pid);

               unset($processes[$pid]);
               $CI->cache->save('processes', $processes, 90000);    //save after updating
           }


        }
    }
}


