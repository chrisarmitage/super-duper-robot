<?php

namespace Application\Adr\Action\Orders;

use Sdr\Domain\Order;
use Symfony\Component\HttpFoundation\Response;

class ViewResponder
{
    /**
     * @param Order $payload
     * @return Response
     */
    public function respond($payload) : Response
    {
        $body = '<a href="/orders">View all</a>';

        $body .= '<table>';
        $body .= '<tr><td>ID</td><td>' . $payload->getId() . '</td></tr>';
        $body .= '<tr><td>State</td><td>' . $payload->getState() . '</td></tr>';
        $body .= '</table>';

        $body .= '<a href="/orders/view/' . $payload->getId() . '/dispatch">Dispatch</a>';

        return new Response(
            $body,
            Response::HTTP_OK,
            [
                'content-type' => 'text/html',
            ]
        );
    }
}
