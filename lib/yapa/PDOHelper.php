<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 7:08
 */

namespace yapa;

class PDOHelper {

    /**
     * @var \PDO
     */
    private static $pdo;

    /**
     * @return \PDO
     */
    public static function getPDO() {
        if(is_null(self::$pdo)) {
            self::$pdo = new \PDO("mysql:dbname=test;host=localhost", "root", "1235");
        }
        return self::$pdo;
    }

} 