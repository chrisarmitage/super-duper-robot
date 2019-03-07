<?php

namespace Application\Adr\Action\Skus;

use Framework\Controller;
use Sdr\Repository\SkuReadRepository;

class Index implements Controller
{
    /**
     * @var SkuReadRepository
     */
    protected $domain;

    /**
     * @var IndexResponder
     */
    protected $responder;

    /**
     * Index constructor.
     * @param SkuReadRepository $domain
     * @param IndexResponder    $responder
     */
    public function __construct(SkuReadRepository $domain, IndexResponder $responder)
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
