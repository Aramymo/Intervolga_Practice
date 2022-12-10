<?php
namespace App;

/**
 * SQLite connnection
 */
class SQLiteConnection {
    private $pdo;

    public function connect() {
        $path = __DIR__ . '/../config/config.json';
        $config_handle = fopen($path, 'r');
        $text = fread($config_handle,filesize($path));
        $json = json_decode($text, true);
        fclose($config_handle);
        if ($this->pdo == null) {
            $this->pdo = new \PDO("sqlite:" . $json['DB_Path']);
        }
        return $this->pdo;
    }
}
