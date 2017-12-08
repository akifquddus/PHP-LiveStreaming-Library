<?php

    function loadCache() {
        $CI = & get_instance();
        $CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        return $CI;
    }
    function getCache($key) {
        $CI = loadCache();
        return $CI->cache->get($key);
    }

    function saveInCache($key, $value) {

        $CI = loadCache();
        $CI->cache->save($key, $value, 4000);
    }

    function saveProcess($PID) {
        $CI = loadCache();
        if ( ! $processes = $CI->cache->get('processes'))
        {
            $processes = [];
        }
        $processes[$PID] = time();
        $CI->cache->save('processes', $processes, 4000);
    }

    function clean() {
        $CI = loadCache();
        $processes = $CI->cache->get('processes');
        if(is_array($processes)) {
            foreach ($processes as $key => $theProcess) {

            }
        }
    }


