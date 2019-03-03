<?php

namespace Application\Adr\Action\Orders;

use Sdr\Domain\Order;
use Symfony\Component\HttpFoundation\Response;

class IndexResponder
{
    public function respond($payload) : Response
    {
        $body = '<table>';
        /** @var Order $order */
        foreach ($payload as $order) {
            $body .= '<tr><td><a href="/orders/view/' . $order->getId() . '">' . $order->getId() . '</a></td><td>' . $order->getState() . '</td></tr>';
        }
        $body .= '</table>';

        $body .= '<a href="/orders/create">New Order</a>';

        return new Response(
            $body,
            Response::HTTP_OK,
            [
                'content-type' => 'text/html',
            ]
        );
    }
}
