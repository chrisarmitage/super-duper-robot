<?php

declare(strict_types=1);

namespace Application\Controller\Orders\Action;

use Framework\Controller;

class Dispatch implements Controller
{
    public function dispatch()
    {
        return [
            'dispatch' => true,
        ];
    }
}
