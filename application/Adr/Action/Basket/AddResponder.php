<?php

namespace Application\Adr\Action\Basket;

use Symfony\Component\HttpFoundation\RedirectResponse;

class AddResponder
{
    public function respond($skuCode) : RedirectResponse
    {
        return new RedirectResponse(
            '/skus/view/' . $skuCode
        );
    }
}
