<?php

declare(strict_types=1);

use App\Controller\IndexController;

return
    [
        'GET'  =>
            [
                'index'    => [IndexController::class, 'index'],
                'indexs'    => [],
            ],
        'POST' =>
            [
                'checkUsers'    => 'login/checkUsers',
                'logout'        => 'login/logout',
                'registerUsers' => 'register/registerUsers',
                'checkLogin'    => 'register/checkLogin',
            ],
    ];