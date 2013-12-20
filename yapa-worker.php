<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 3:30
 */

namespace yapa;

use yapa\parsers\YandexParser;

require_once 'vendor/autoload.php';

$options = json_decode(stream_get_contents(STDIN), true);

$parser = new YandexParser($options);

$result = json_encode($parser->getResult());

if(isset($result['error'])) {
    die($result['error']);
}

exit;