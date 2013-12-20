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

$result = $parser->getResult();

if(isset($result['error'])) {
    die($result['error']);
}

$insert = PDOHelper::getPDO()->prepare(
    "INSERT INTO domains (domain, keyword, `count`) VALUES (:domain, :keyword, :count)
    ON DUPLICATE KEY UPDATE `count` = :count");

foreach($result as $key => $item) {
    $insert->bindValue(':domain', $key);
    $insert->bindValue(':keyword', $options['keyword_id']);
    $insert->bindValue(':count', $item);

    $insert->execute();
}

exit;