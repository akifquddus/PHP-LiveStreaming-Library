<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once '../../libraries/Streams.php';

use Symfony\Component\Process\Process;
class Stream extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $process = new Process('ping 8.8.8.8');
	    echo "yo";
	}

	public function start() {

    }

    public function t() {
        $process = new Process('ping 8.8.8.8');

        $process->start();
        echo "running";
// executes after the command finishes
// will send a SIGKILL to the process
//$process->signal(SIGKILL);

// executes after the command finishes
        $process = json_encode($process);

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

//        $process = new Process('ping 8.8.8.8 -t');
//        $process->start();
        //$process->disableOutput();
//        $pid = $process->getPid();
        Stream::set('x');
        var_dump(Stream::$persistentData);
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
}
