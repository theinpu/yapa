<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 1:25
 */

namespace yapa;

class Job {

    private $proc;
    private $pipes;
    private $result = array();
    private $keyword;

    public function __construct($keyword) {
        echo "job start. keyword: {$keyword}\n";
        $this->keyword = $keyword;
        $this->proc = proc_open(getcwd() . "/yapa-worker",
            array(
                array('pipe', 'r'),
                array('pipe', 'w'),
                STDERR
            ),
            $this->pipes
        );
    }

    public function isFinished() {
        if(is_resource($this->proc)) {
            if(is_resource($this->pipes[0])) {
                fwrite($this->pipes[0], json_encode(
                    array(
                        'keyword' => $this->keyword
                    )));
                fclose($this->pipes[0]);
            }
            $stat = proc_get_status($this->proc);
            if(!$stat['running']) {
                $result = stream_get_contents($this->pipes[1]);
                if(!empty($result)) {
                    $this->result =
                        json_decode($result, true);
                }
                fclose($this->pipes[1]);
                proc_close($this->proc);
            }
            return false;
        }
        return true;
    }

    public function getResult() {
        return $this->result;
    }

    public function getKeyword() {
        return $this->keyword;
    }
}