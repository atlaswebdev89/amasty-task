<?php

namespace App\Controller;

use App\Core\Controller\AbstractController;
use App\Model\IndexModel;

class IndexController extends AbstractController
{
    public function index() {
        $model = new IndexModel();
        var_dump($model->getData());
        echo "START IndexController ";
        echo "locale: ".$this->locale;
    }
}