<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\Process\Process;
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
        $source = $this->input->post('source');
        $destination = $this->input->post('destination');

        if($process = FFMPEG_START_STREAM('D:\red5-server\webapps\oflaDemo\streams\emi.mp4', 'save.mp4')) {
            saveProcess($process->getPid());
//            var_dump(getCache('processes'));

            echo json_encode(
                array(
                    'status'    =>  true,
                    'PID'       =>  $process->getPid()
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

        if(FFMPEG_KILL_PROCESS($PID)) {
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
                    'message'   =>  'Terminated Process '.$PID.' successfully.'
                )
            );
        }
    }


    /**
     * Testing Region
     */
    #region Testing functions

    public function t() {
        $process = new Process('ping 8.8.8.8');

        $process->start();
        echo "running";
        // executes after the command finishes
        // will send a SIGKILL to the process
        //$process->signal(SIGKILL);

        // executes after the command finishes
        $process = json_encode($process);
        $i = 0;
        foreach ($process as $type => $data) {
            if ($process::OUT === $type) {
                echo "<br />".$data;
                if($i == 2) {
                    $process->signal('SIGKILL');
                }
                $i++;
            } else { // $process::ERR === $type
                echo "<br />\nRead from stderr: ".$data;
            }
        }

    }

    public function test() {
        $stream_url = $this->input->post('stream_url');
        $video = $this->input->post('video');

        $process = new Process('ls -lsa');
        $process->start();
//        $process->disableOutput();
        $pid = $process->getPid();

        saveProcess($pid);
        var_dump(getCache('processes'));
//        echo serialize($process);
    }

    public function ping() {
        $process = new Process('ping 8.8.8.8 -t');
        //$process->disableOutput();
        $process->start();

        // executes after the command finishes
        // will send a SIGKILL to the process
        //$process->signal(SIGKILL);

        // executes after the command finishes
//        $process = json_encode($process);

        $i = 0;
        foreach ($process as $type => $data) {
            if ($process::OUT === $type) {
                echo "<br />".$data;
                if($i == 2) {
                    $process->signal('SIGKILL');
                }
                $i++;
            } else { // $process::ERR === $type
                echo "<br />\nRead from stderr: ".$data;
            }
        }

    }

    public function exeaction() {
        if($process = FFMPEG_START_STREAM('D:\red5-server\webapps\oflaDemo\streams\emi.mp4', 'save.mp4')) {
            saveProcess($process->getPid());
//            var_dump(getCache('processes'));

            echo json_encode(
                array(
                    'status'    =>  true,
                    'PID'       =>  $process->getPid()
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


    #endregion

}
