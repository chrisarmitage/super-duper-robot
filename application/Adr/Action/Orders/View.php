<?php

namespace Application\Adr\Action\Orders;

use Framework\Controller;
use Sdr\Domain\OrderId;
use Sdr\Repository\OrderReadRepository;
use Symfony\Component\HttpFoundation\Request;

class View implements Controller
{
    /**
     * @var OrderReadRepository
     */
    protected $domain;

    /**
     * @var ViewResponder
     */
    protected $responder;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Index constructor.
     * @param OrderReadRepository $domain
     * @param ViewResponder       $responder
     * @param Request             $request
     */
    public function __construct(OrderReadRepository $domain, ViewResponder $responder, Request $request)
    {
        $this->domain = $domain;
        $this->responder = $responder;
        $this->request = $request;
    }

    public function dispatch($id)
    {
        $payload = $this->domain->get(
            OrderId::create($id)
        );
        return $this->responder->respond($payload);
    }
}
