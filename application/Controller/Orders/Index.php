<?php

declare(strict_types=1);

namespace Application\Controller\Orders;

use Framework\Controller;

class Index implements Controller
{
    public function dispatch()
    {
        return [
            'orders' => [],
        ];
    }
}
