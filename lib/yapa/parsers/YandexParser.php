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

    public function getResult() {
        $result = array();
        sleep(rand(1,5));
        /*$ya = new \Yandex(self::USER, self::KEY);
        $ya->query($this->getOption('query'))
            ->page($this->getOption('page'))
            ->limit($this->getOption('perPage'))
            ->request();
        if(!isset($ya)) {
            return array('error' => 'generic error');
        }
        if(!empty($ya->error)) {
            return array('error' => $ya->error);
        }

        $result['pages'] = $ya->total();

        $domains = array();
        foreach($ya->results() as $item) {
            $domains[] = $item->domain;
        }
        $domains = array_unique($domains);
        $result['domains'] = $domains;*/

        return $result;
    }
}