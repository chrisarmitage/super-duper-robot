<?php

namespace Application\Adr\Action\Orders;

use Symfony\Component\HttpFoundation\RedirectResponse;

class DispatchResponder
{
    public function respond($orderId) : RedirectResponse
    {
        return new RedirectResponse(
            '/orders/view/' . $orderId
        );
    }
}
