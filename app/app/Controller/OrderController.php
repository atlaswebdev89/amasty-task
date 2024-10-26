<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Controller\AbstractController;
use App\Service\Price;
use App\Model\OrderModel;

class OrderController extends AbstractController
{
    /**
     * @var Price
     */
    protected Price $price;

    /**
     * @var OrderModel
     */
    protected OrderModel $order;

    public function __construct()
    {
        parent::__construct();
        $this->price = new Price();
        $this->order = new OrderModel();
    }

    /**
     * @return void
     * @throws \JsonException
     */
    public function order(): void
    {
        $requestData = $this->request->getPost();
        echo "<PRE>";
        print_r($requestData);
        echo "</PRE>";
        $orderData = $this->order->getModelData($requestData);
        $price = $this->price->getPrice($orderData, $requestData);
        $this->response->json($price);
    }
}