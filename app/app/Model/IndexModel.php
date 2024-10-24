<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Model\AbstractModel;

class IndexModel extends AbstractModel
{
    protected $table = 'amasty';

    /**
     * @param array|null $data
     *
     * @return mixed
     */
    public function getData(array $data = null): mixed
    {
        $sql = "SELECT * FROM `" . $this->table . "`";
        $result =  $this->query($sql, 'fetch');
        if ($result) {
            return $result;
        }
        return [];
    }
}