<?php

declare(strict_types=1);

use App\Controller\IndexController;
use App\Controller\OrderController;

return
    [
        'GET'  =>
            [
                'index' => [IndexController::class, 'index'],
                'order' => [OrderController::class, 'order'],
            ],
        'POST' =>
            [
                'order' => [OrderController::class, 'order'],
            ],
    ];