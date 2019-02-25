<?php


namespace Application\Adr\Action\Orders;

use Symfony\Component\HttpFoundation\RedirectResponse;

class CreateResponder
{
    public function respond() : RedirectResponse
    {
        return new RedirectResponse(
            '/orders'
        );
    }
}
