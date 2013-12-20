<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 1:15
 */

namespace yapa;

class JobControl {

    private $keywords;
    private $jobsLimit;
    /**
     * @var Job[]
     */
    private $jobs;

    private $results = array();
    private $nextKeyword = 0;

    public function __construct($jobs) {
        $this->jobsLimit = $jobs;
        $this->keywords = array('Yandex', 'test');
    }

    public function isRun() {
        if(count($this->jobs) < $this->jobsLimit
            && count($this->keywords) > $this->nextKeyword) {
            $this->startJob($this->keywords[$this->nextKeyword]);
        }
        if(count($this->jobs) > 0) {
            foreach($this->jobs as $key => $job) {
                if($job->isFinished()) {
                    echo "job finish. keyword: ".($job->getKeyword())."\n";
                    $this->results[] = $job->getResult();
                    unset($this->jobs[$key]);
                    continue;
                }
            }
        }
        if(count($this->jobs) == 0) {
            return false;
        }
        return true;
    }

    private function startJob($keyword) {
        $this->jobs[] = new Job($keyword);
        $this->nextKeyword++;
    }
}