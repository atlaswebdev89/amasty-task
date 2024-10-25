<?php

namespace App\Controller;

use App\Core\Controller\AbstractController;
use App\Model\IndexModel;

class IndexController extends AbstractController
{
    public function index(): void
    {
        $model = new IndexModel();
        $this->view->render('index.phtml', [
            'title' => 'Home Page',
            'formTitle' => 'Order pizza',
            'currency' => $this->currency,
            'pizzas' => $model->getPizza(),
            'sauces' => $model->getSauce(),
            'sizes' => $model->getSize(),
        ]);
    }
}