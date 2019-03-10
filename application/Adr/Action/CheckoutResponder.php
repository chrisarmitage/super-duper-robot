<?php

namespace Application\Adr\Action;

use Symfony\Component\HttpFoundation\RedirectResponse;

class CheckoutResponder
{
    public function respond($orderId) : RedirectResponse
    {
        return new RedirectResponse(
            '/orders/view/' . $orderId
        );
    }
}
