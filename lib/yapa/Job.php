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
    private $result;
    private $query;
    private $page;
    private $perPage;

    public function __construct($query, $page, $perPage) {
        echo "job start. get page #{$page}\n";
        $this->query = $query;
        $this->page = $page;
        $this->perPage = $perPage;
        $this->proc = proc_open(getcwd() . "/yapa-worker",
            array(
                array('pipe', 'r'),
                array('pipe', 'w'),
                STDERR
            ),
            $this->pipes
        );
    }

    public function getPages() {
        return 50;
    }

    public function isFinished() {
        if(is_resource($this->proc)) {
            if(is_resource($this->pipes[0])) {
                fwrite($this->pipes[0], json_encode(array(
                    'query' => $this->query,
                    'page' => $this->page,
                    'perPage' => $this->perPage
                )));
                fclose($this->pipes[0]);
            }
            $stat = proc_get_status($this->proc);
            if(!$stat['running']) {
                $this->result = stream_get_contents($this->pipes[1]) . "\n";
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

    public function getPage() {
        return $this->page;
    }
}