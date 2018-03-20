<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Stream
 * Default Controller to Use STREAMING LIBRARY for Bleupage.
 */
class Stream extends CI_Controller {


    /**
     * Stream constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('Servercache');
        $this->load->helper('ffmpeg');

        //Helper to write anytype of tests we require
        $this->load->helper('tests');

    }

    /**
     * Homepage function for our Streaming Server
     */
    public function index()
    {

    }

    /**
     * Cron to stop and remove from cache all process older than 24 hours
     * @require FFMPEG_HELPER
     */
    function cleancache() {
        CACHE_CLEAN_ALL();
    }

    /**
     * Will Start Streaming from specified source to destination.
     * @param source
     * @param destination
     */
    function startstream() {
        $source = "https:" . $this->input->post('source');
        $source = str_replace(' ', '%20', $source);
        $destination = urldecode($this->input->post('destination'));

        if($process = FFMPEG_START_STREAM($source, $destination)) {
            saveProcess($process->getPid());
            echo json_encode(
                array(
                    'status'    =>  true,
                    'PID'       =>  $process->getPid(),
                    'source' => $source,
                    'destination' => $destination,
                )
            );

        } else {
            echo json_encode(
                array(
                    'status'        =>  false,
                    'message'       =>  '0x2031: Oops, Something went wrong! Unable to start Processing.'
                )
            );
        }

    }

    /**
     * Will Stop Stream provided by PID
     * @param PID
     */
    function stopstream() {
        $PID = (int) $this->input->post('PID');

        $result = FFMPEG_KILL_PROCESS($PID);
        if($result == true) {
            echo json_encode(
                array(
                    'status'    =>  true,
                    'message'   =>  'Terminated Process '.$PID.' successfully.'
                )
            );
        } else {
            echo json_encode(
                array(
                    'status'    =>  false,
                    'message'   =>  $result
                )
            );
        }
    }

}
