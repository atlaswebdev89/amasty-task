<?php

namespace App\Core\Model;

use App\Core\Connections\Mysql\MysqlConnection;
use App\Interface\QueryInterface;

abstract class AbstractModel implements QueryInterface
{
    /**
     * @var \PDO
     */
    protected \PDO $mysql;

    public function __construct() {
        $this->mysql = MysqlConnection::getConnection();
    }

    /**
     * @param $sql
     * @param $type
     * @param array|null $data
     *
     * @return array|false|int|string|void
     */
    public function query($sql, $type, array $data = NULL): mixed
    {
        switch ($type) {
            case 'fetch':
                $row =  $this->mysql->prepare($sql);
                $row->execute($data);
                return $row->fetchAll();
            case 'count':
                $row =  $this->mysql->prepare($sql);
                $row->execute($data);
                return $row->rowCount();
            case 'insert':
                $row = $this->mysql->prepare($sql);
                $row->execute($data);
                return $this->mysql->lastInsertId();
        }
    }

    /**
     * @param array|null $data
     *
     * @return mixed
     */
    abstract public function getData(array $data = null): mixed;
}