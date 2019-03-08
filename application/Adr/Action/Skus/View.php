<?php

namespace Application\Adr\Action\Skus;

use Framework\Controller;
use Sdr\Domain\SessionId;
use Sdr\Domain\SkuCode;
use Sdr\Repository\BasketReadRepository;
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
     * @var BasketReadRepository
     */
    protected $basketRepository;

    /**
     * Index constructor.
     * @param SkuReadRepository    $domain
     * @param ViewResponder        $responder
     * @param Request              $request
     * @param BasketReadRepository $basketRepository
     */
    public function __construct(SkuReadRepository $domain, ViewResponder $responder, Request $request, BasketReadRepository $basketRepository)
    {
        $this->domain = $domain;
        $this->responder = $responder;
        $this->request = $request;
        $this->basketRepository = $basketRepository;
    }

    public function dispatch($id)
    {
        $payload = $this->domain->get(
            SkuCode::create($id)
        );
        $basket = $this->basketRepository->getBySession(
            new SessionId(session_id())
        );

        return $this->responder->respond($payload, $basket);
    }
}
