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
    private $gotPages = 1;

    private $results = array();

    private $firstRun = true;

    public function __construct($jobs) {
        $this->jobsLimit = $jobs;
    }

    public function isRun() {
        if(empty($this->query)) {
            throw new \Exception("run JobControl::setQuery first");
        }
        if($this->firstRun) {
            $this->startJob(1);
            $this->firstRun = false;
        }
        if($this->gotPages > $this->pages
            && !is_null($this->pages)
            && count($this->jobs) == 0
        ) {
            return false;
        }
        if(count($this->jobs) > 0) {
            foreach($this->jobs as $key => $job) {
                if($job->isFinished()) {
                    echo "job finish. got page #".($job->getPage())."\n";
                    if(is_null($this->pages)) {
                        $this->pages = $job->getPages();
                    }
                    $this->results[] = $job->getResult();
                    unset($this->jobs[$key]);
                    continue;
                }
            }
        }
        if(count($this->jobs) < $this->jobsLimit && !is_null($this->pages)) {
            $this->gotPages++;
            $this->startJob($this->gotPages);
        }
        return true;
    }

    public function setQuery($query) {
        $this->query = $query;
    }

    public function setResultsPerPage($perPage) {
        $this->perPage = $perPage;
    }

    private function startJob($page) {
        if($this->gotPages > $this->pages && !is_null($this->pages)) return;
        $this->jobs[] = new Job($this->query, $page, $this->perPage);
    }
}