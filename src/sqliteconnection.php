<?php
namespace App;

/**
 * SQLite connnection
 */
class SQLiteConnection {
    private static $instance = null;
    private $connection = null;
    protected function __construct()
    {
        //Открытие конфиг.файла для получения пути к БД
        $path = __DIR__ . '/../config/config.json';
        $config_handle = fopen($path, 'r');
        $text = fread($config_handle,filesize($path));
        $json = json_decode($text, true);
        fclose($config_handle);
        if ($this->connection == null) {
            //Подключение к БД
            $this->connection = new \PDO("sqlite:" . $json['DB_Path']);
        }
    }
    public static function getInstance(): SQLiteConnection
    {
        if (null === self::$instance)
        {
            self::$instance = new static();
        }
        return self::$instance;
    }
    public static function connect(): \PDO
    {
        return static::getInstance()->connection;
    }
    public static function prepare($statement): \PDOStatement
    {
        return static::connect()->prepare($statement);
    }
}
