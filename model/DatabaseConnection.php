<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-07
 * Time: 12:52
 */

namespace model;


class DatabaseConnection
{
    private $connection;
    private $stmt;

    public function __construct() {
        try {
            $settings = parse_ini_file('Database.Settings');
            var_dump($settings);
            $this->connection = new \PDO('mysql:host='.$settings['DB_HOST'].';dbname='.$settings['DB_DATABASE'],$settings['DB_USERNAME'],$settings['DB_PASSWORD'],
                array(PDO::ATTR_EMULATE_PREPARES => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}