<?php

declare(strict_types=1);

namespace App\Core\Connections\Mysql;

use App\Interface\ConnectionInterface;
use App\Core\Config;

class MysqlConnection implements ConnectionInterface
{
    /**
     * Path to database connection config
     */
    protected const string DATABASE_CONFIG = 'database';

    /**
     * Name connection
     */
    protected const string DB_CONNECTION = 'mysql';

    /**
     * @var \PDO
     */
    protected static $connection;

    /**
     * @var MysqlConnection
     */
    protected static $_instance;

    /**
     * @var array
     */
    private array $config;

    private function __construct()
    {
        $config = Config::getConfig(self::DATABASE_CONFIG);
        $this->config = (array_key_exists(self::DB_CONNECTION, $config['connections']))
            ? $this->config = $config['connections'][self::DB_CONNECTION]
            : [];

        if (!count($this->config)) {
            throw new \PDOException("Not connection to database");
        }
        $this->connectDB();
    }

    /**
     * @return \PDO
     */
    protected function connectDB(): \PDO
    {
        if (self::$connection instanceof \PDO) {
            return self::$connection;
        }
        self::$connection = new \PDO(
            "mysql:host=" . $this->config['host'] . ";port=" . $this->config['port'] . ";dbname=" . $this->config['database'] . ";charset=utf8mb4",
            $this->config['username'],
            $this->config['password']
        );
        self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

        return self::$connection;
    }

    /**
     * @return void
     */
    public static function getInstance(): void
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
    }

    /**
     * @return \PDO
     */
    public static function getConnection(): \PDO
    {
        self::getInstance();

        return self::$connection;
    }
}