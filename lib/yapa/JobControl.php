<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 1:15
 */

namespace yapa;

class JobControl {

    /**
     * @var string
     */
    private $query;
    /**
     * @var int
     */
    private $perPage = 0;
    /**
     * @var int
     */
    private $jobsLimit;
    /**
     * @var Job[]
     */
    private $jobs;
    /**
     * @var int
     */
    private $pages;
    private $gotPages = 0;

    private $results = array();

    public function __construct($jobs) {
        $this->jobsLimit = $jobs;
    }

    public function isRun() {
        if(empty($this->query)) {
            throw new \Exception("run JobControl::setQuery first");
        }
        if($this->gotPages >= $this->pages && !is_null($this->pages)) {
            return false;
        }
        if(count($this->jobs) <= $this->jobsLimit) {
            $this->jobs[] = new Job($this->query, $this->pages);
        }
        if(count($this->jobs) > 0) {
            echo "jobs count: ".count($this->jobs)."\n";
            foreach($this->jobs as $key => $job) {
                if($job->isFinished()) {
                    echo "job finish. got page #".($this->gotPages + 1)."\n";
                    if(is_null($this->pages)) {
                        $this->pages = $job->getPages();
                    }
                    $this->results[] = $job->getResult();
                    $this->gotPages++;
                    unset($this->jobs[$key]);
                    continue;
                }
            }
        }
        return true;
    }

    public function setQuery($query) {
        $this->query = $query;
    }

    public function setResultsPerPage($perPage) {
        $this->perPage = $perPage;
    }
}