<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 4:20
 */

namespace yapa\parsers;

require_once 'lib/Yandex.php';

class YandexParser extends Parser {

    const USER = "Enzo123";
    const KEY = "03.2155339:fcbedf09b87188a21b5a4fbdc0d11ca2";
    const PER_PAGE = 100;
    const YANDEX_RESULT_LIMIT = 1000;

    /**
     * @var \Yandex
     */
    private $ya;
    private $domains = array();

    public function __construct($options) {
        parent::__construct($options);
        $this->ya = new \Yandex(self::USER, self::KEY);
    }


    public function getResult() {
        $page = 1;
        try {
            $this->query($page);
        }
        catch(\Exception $e) {
            return array('error' => $e->getMessage());
        }
        $pages= $this->ya->pages();
        $this->countDomains();
        $page++;
        for(;$page < $pages && $page < self::YANDEX_RESULT_LIMIT / self::PER_PAGE;
             $page++) {
            try {
                $this->query($page);
            }
            catch(\Exception $e) {
                return array('error' => $e->getMessage()
                    .'; page:'.$page."; pages:".$pages);
            }
            $this->countDomains();
        }

        return $this->domains;
    }

    /**
     * @param int $page
     * @throws \Exception
     */
    private function query($page) {
        $this->ya->query($this->getOption('keyword'))
            ->page($page)
            ->limit(self::PER_PAGE)
            ->request();
        if(!isset($this->ya)) {
            throw new \Exception('Generic error');
        }
        if(!empty($this->ya->error)) {
            throw new \Exception($this->ya->error);
        }
    }

    /**
     * @return array
     */
    private function countDomains() {
        foreach($this->ya->results() as $item) {
            if(!array_key_exists((string)$item->domain, $this->domains)) {
                $this->domains[(string)$item->domain] = 0;
            }
            $this->domains[(string)$item->domain]++;
        }
    }

}