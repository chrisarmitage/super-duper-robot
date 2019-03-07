<?php

namespace Application\Adr\Action\Skus;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class IndexResponder
{
    /**
     * @var Environment
     */
    protected $twig;

    /**
     * IndexResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function respond($payload) : Response
    {
        return new Response(
            $this->twig->render('skus/index.twig', ['skus' => $payload]),
            Response::HTTP_OK,
            [
                'content-type' => 'text/html',
            ]
        );
    }
}
