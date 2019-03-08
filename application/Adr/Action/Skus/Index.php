<?php

namespace Application\Adr\Action\Skus;

use Framework\Controller;
use Sdr\Domain\SessionId;
use Sdr\Repository\BasketReadRepository;
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
     * @var BasketReadRepository
     */
    protected $basketRepository;

    /**
     * Index constructor.
     * @param SkuReadRepository    $domain
     * @param IndexResponder       $responder
     * @param BasketReadRepository $basketRepository
     */
    public function __construct(SkuReadRepository $domain, IndexResponder $responder, BasketReadRepository $basketRepository)
    {
        $this->domain = $domain;
        $this->responder = $responder;
        $this->basketRepository = $basketRepository;
    }

    public function dispatch()
    {
        $payload = $this->domain->getAll();
        $basket = $this->basketRepository->getBySession(
            new SessionId(session_id())
        );

        return $this->responder->respond($payload, $basket);
    }
}
