<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 4:20
 */

namespace yapa\parsers;

class YandexParser extends Parser {

    public function getResult() {
        sleep(rand(1,5));
        return array('');
    }
}