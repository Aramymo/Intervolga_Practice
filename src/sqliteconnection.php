<?php

namespace App;

class sqliteconnection {
    private static $instance = null;
    private $connection = null;

    protected function __construct() {
        $path = __DIR__ . '/../config/config.json';
        $config_handle = fopen($path, 'r');
        $text = fread($config_handle,filesize($path));
        $json = json_decode($text, true);
        fclose($config_handle);

        if ($this->connection == null) {
            $this->connection = new \PDO("sqlite:" . $json['DB_Path']);
        }
    }

    public static function getInstance(): sqliteconnection {

        if (self::$instance === null)
        {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function connect(): \PDO {
        return static::getInstance()->connection;
    }

    public static function prepare(string $statement): \PDOStatement
    {
        return static::connect()->prepare($statement);
    }
}
