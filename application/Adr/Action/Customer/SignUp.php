<?php

namespace Application\Adr\Action\Customer;

use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;

class SignUp implements Controller
{
    /**
     * @var SignUpResponder
     */
    protected $responder;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param SignUpResponder $responder
     * @param Request         $request
     */
    public function __construct(SignUpResponder $responder, Request $request)
    {
        $this->responder = $responder;
        $this->request = $request;
    }

    public function dispatch()
    {
        if ($this->request->getMethod() === Request::METHOD_GET) {
            return $this->responder->respond();
        }

        if ($this->request->getMethod() === Request::METHOD_POST) {
            $customerId = CustomerRepository::nextIdentity();

            $this->commandBus->execute(
                new SignUpCustomerCommand(
                    new SessionId(session_id()),
                    $this->request->get('first_name'),
                    $this->request->get('email'),
                    $this->request->get('password')
                )
            );

            return $this->responder->respond();
        }
    }
}
