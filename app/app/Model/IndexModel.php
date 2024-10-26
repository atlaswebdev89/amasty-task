<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Model\AbstractModel;

class IndexModel extends AbstractModel
{

    /**
     * @param string $table
     * @param array|null $data
     *
     * @return mixed
     */
    public function getData(string $table, array $data = null): mixed
    {
        $sql = "SELECT * FROM `" . $table . "`";
        $result =  $this->query($sql, 'fetch');
        if ($result) {
            return $result;
        }
        return [];
    }

    /**
     * @return mixed
     */
    public function getPizza(): mixed {
        return $this->getData('pizza');
    }

    /**
     * @return mixed
     */
    public function getSize(): mixed
    {
        return $this->getData('size');
    }

    /**
     * @return mixed
     */
    public function getSauce(): mixed
    {
        return $this->getData('sauce');
    }
}