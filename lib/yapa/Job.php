<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 1:25
 */

namespace yapa;

class Job {

    private $query;
    private $perPage;

    public function __construct($query, $perPage) {
        $this->query = $query;
        $this->perPage = $perPage;
        echo "job start\n";
    }

    public function getPages() {
        return 10;
    }

    public function isFinished() {
        return true;
    }

    public function getResult() {
        return array('keyword', 'domain');
    }
}