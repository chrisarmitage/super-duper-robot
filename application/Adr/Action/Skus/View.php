<?php

namespace Application\Adr\Action\Skus;

use Framework\Controller;
use Sdr\Domain\SkuCode;
use Sdr\Repository\SkuReadRepository;
use Symfony\Component\HttpFoundation\Request;

class View implements Controller
{
    /**
     * @var SkuReadRepository
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
     * @param SkuReadRepository $domain
     * @param ViewResponder       $responder
     * @param Request             $request
     */
    public function __construct(SkuReadRepository $domain, ViewResponder $responder, Request $request)
    {
        $this->domain = $domain;
        $this->responder = $responder;
        $this->request = $request;
    }

    public function dispatch($id)
    {
        $payload = $this->domain->get(
            SkuCode::create($id)
        );
        return $this->responder->respond($payload);
    }
}
