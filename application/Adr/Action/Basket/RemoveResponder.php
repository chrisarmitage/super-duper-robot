<?php

namespace Application\Adr\Action\Basket;

use Symfony\Component\HttpFoundation\RedirectResponse;

class RemoveResponder
{
    public function respond() : RedirectResponse
    {
        return new RedirectResponse(
            '/skus'
        );
    }
}
