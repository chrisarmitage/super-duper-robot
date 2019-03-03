<?php

namespace Application\Adr\Action\Orders;

use Sdr\Domain\Order;
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
     * @param Order $payload
     * @return Response
     */
    public function respond($payload) : Response
    {
        return new Response(
            $this->twig->render('orders/view.twig', ['order' => $payload]),
            Response::HTTP_OK,
            [
                'content-type' => 'text/html',
            ]
        );
    }
}
