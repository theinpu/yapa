<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 1:26
 */

namespace yapa\parsers;


abstract class Parser {

    private $options;

    public abstract function getResult();

    public function __construct($options) {
        $this->options = $options;
    }

    protected function getOption($name) {
        if(!array_key_exists($name, $this->options)) return null;
        return $this->options[$name];
    }

} 