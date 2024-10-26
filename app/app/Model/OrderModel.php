<?php

namespace App\Model;

use App\Core\Model\AbstractModel;

class OrderModel extends AbstractModel
{
    /**
     * @param string $table
     * @param array|null $data
     *
     * @return mixed
     */
    public function getData(string $table, array $data = null): mixed
    {
        $sql = "SELECT * FROM `" . $table . "` WHERE `id`=:id";
        $data_array = [
            'id' => $data['id'],
        ];
        $result = $this->query($sql, 'fetch', $data_array);
        if ($result) {
            return $result[0];
        }

        return [];
    }

    /**
     * @param array|null $data
     *
     * @return mixed
     */
    public function getModelData(array $data = null): mixed
    {
        $result = [];
        if (count($data)) {
            $result = [
                'pizza' => $this->getData('pizza', ['id' => $data['pizza']]),
                'sauce' => $this->getData('sauce', ['id' => $data['sauce']]),
                'size'  => $this->getData('size', ['id' => $data['size']]),
            ];
        }

        return $result;
    }

}