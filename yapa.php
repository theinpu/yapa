<?php
/**
 * User: inpu
 * Date: 19.12.13
 * Time: 21:53
 */

namespace yapa;

require_once 'vendor/autoload.php';
require_once 'lib/Yandex.php';

use Symfony\Component\Console\Application;

class CliApp extends Application {

    static $cliPath;

    function __construct() {
        parent::__construct('yapa');
    }

    function addEntityCommands(array $obj) {
        $this->addCommands($obj);
    }

}

$cliApp = new CliApp();

$cliApp->addEntityCommands(array(new RunCommand()));

$cliApp->run();