<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once __DIR__ . '/../../vendor/autoload.php';

$container = new \Auryn\Injector();

$container->share($container);

/**
 * Initialise Doctrine
 */
Type::addType(
    'OrderId',
    \Sdr\DoctrineOrderId::class
);
Type::addType(
    'SkuCode',
    \Sdr\DoctrineSkuCode::class
);
Type::addType(
    'BasketId',
    \Sdr\DoctrineBasketId::class
);
Type::addType(
    'SessionId',
    \Sdr\DoctrineSessionId::class
);
Type::addType(
    'BasketItemId',
    \Sdr\DoctrineBasketItemId::class
);
Type::addType(
    'OrderItemId',
    \Sdr\DoctrineOrderItemId::class
);

$config = Setup::createXMLMetadataConfiguration(
    [ __DIR__ . '/../../src/Sdr/Domain/doctrine-entities'],
    false
);
$entityManager = EntityManager::create(
    [
        'driver' => 'pdo_sqlite',
        'path' =>  __DIR__ . '/../../build/db.sqlite',
    ],
    $config
);

$container->share($entityManager);
$container->alias(\Doctrine\ORM\EntityManagerInterface::class, EntityManager::class);

$repo = $container->make(\Sdr\Repository\OrderWriteRepository::class);

$order = new \Sdr\Domain\Order(
    \Sdr\Domain\OrderId::create(null),
    1,
    'pending',
    0,
    new DateTimeImmutable(),
    new DateTimeImmutable()
);

$order->addItem(
    new \Sdr\Domain\OrderItem(
        \Sdr\Domain\OrderItemId::create(null),
        $order,
        \Sdr\Domain\SkuCode::create('MAN-01'),
        1,
        399
    )
);
$order->addItem(
    new \Sdr\Domain\OrderItem(
        \Sdr\Domain\OrderItemId::create(null),
        $order,
        \Sdr\Domain\SkuCode::create('MAN-01'),
        1,
        399
    )
);
$order->addItem(
    new \Sdr\Domain\OrderItem(
        \Sdr\Domain\OrderItemId::create(null),
        $order,
        \Sdr\Domain\SkuCode::create('MAN-02'),
        1,
        599
    )
);

$repo->add($order);
