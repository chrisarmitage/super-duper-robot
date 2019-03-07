<?php

namespace Application\Adr\Action\Skus;

use Sdr\Domain\Sku;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ViewResponder
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

    /**
     * @param Sku $payload
     * @return Response
     */
    public function respond($payload) : Response
    {
        return new Response(
            $this->twig->render('skus/view.twig', ['sku' => $payload]),
            Response::HTTP_OK,
            [
                'content-type' => 'text/html',
            ]
        );
    }
}
