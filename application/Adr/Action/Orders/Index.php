<?php

namespace Application\Adr\Action\Orders;

use Framework\Controller;
use Sdr\Repository\OrderReadRepository;

class Index implements Controller
{
    /**
     * @var OrderReadRepository
     */
    protected $domain;

    /**
     * @var IndexResponder
     */
    protected $responder;

    /**
     * Index constructor.
     * @param OrderReadRepository         $domain
     * @param IndexResponder $responder
     */
    public function __construct(OrderReadRepository $domain, IndexResponder $responder)
    {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function dispatch()
    {
        $payload = $this->domain->getAll();

        return $this->responder->respond($payload);
    }
}
