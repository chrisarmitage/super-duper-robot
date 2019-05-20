<?php

namespace Application\Adr\Action\Customer;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class SignUpResponder
{
    /**
     * @var Environment
     */
    protected $twig;

    /**
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function respond() : Response
    {
        return new Response(
            $this->twig->render(
                'customer/sign-up.twig'
            ),
            Response::HTTP_OK,
            [
                'content-type' => 'text/html',
            ]
        );
    }

}
