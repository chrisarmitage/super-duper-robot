<?php

declare(strict_types=1);

namespace Sdr;

use Auryn\Injector;
use Sdr\Command\CommandInterface;

class CommandBus
{
    /**
     * @var Injector
     */
    protected $container;

    /**
     * @param Injector $container
     */
    public function __construct(Injector $container)
    {
        $this->container = $container;
    }

    public function execute(CommandInterface $command)
    {

        $handler = str_replace('Command', 'Handler', \get_class($command));

        return $this->container
            ->make($handler)
            ->handle($command);
    }
}
