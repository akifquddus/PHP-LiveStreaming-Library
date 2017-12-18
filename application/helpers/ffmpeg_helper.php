<?php
/**
 * Dependencies Loaded
 */
use Symfony\Component\Process\Process;

/**
 * Installation path of ffmpeg
 */
define('FFMPEG_PATH', 'ffmpeg');

/**
 * Complete Command should be something like this
 *
 * e.g. ffmpeg -re -i ./emi.mp4 -acodec copy -vcodec copy -f flv "rtmp://live-api-a.facebook.com:80/rtmp/1734066443569412?ds=1&a=ATi-uY_zz48mRNqw"
 *
 */
define('FFMPEG_STREAM_COMMPAND_PART_1', FFMPEG_PATH.' -re -i ');
define('FFMPEG_STREAM_COMMPAND_PART_2', ' -acodec copy -vcodec copy -f flv ');

/**
 * Extra Tweaking Variables
 */
define('ENV_IS_DEBUG', false);
define('IS_LINUX', TRUE);


/**
 * Starts Stream from @source to @destination using ffmpeg on RTMP Protocol
 * Returns true if success and false if something goes wrong.
 * @param $source
 * @param $destination
 * @return bool|Process
 */
function FFMPEG_START_STREAM($source, $destination) {
    $response = false;
    $streamCommand_string = "";    //Streaming URL Rendering

    try {   //Just incase something comes unexpected

        $streamCommand_string .= FFMPEG_STREAM_COMMPAND_PART_1;
        $streamCommand_string .= '"'.$source.'"';
        $streamCommand_string .= FFMPEG_STREAM_COMMPAND_PART_2;
        $streamCommand_string .= '"'.$destination.'"';

//        echo $streamCommand_string;


        $process = new Process($streamCommand_string);
        $process->start();

        return $process;
    } catch (Exception $exception) {    //Overall any type of exception.
        //In case Debuging active
        if(ENV_IS_DEBUG) {
            echo $exception->getCode().": ".$exception->getMessage();
        }
        return false;
    }


    return $response;
}


