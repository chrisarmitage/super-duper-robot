<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

$skus = [
    [
        'code' => 'POT-HEAL-LSR',
        'title' => 'Lesser Healing Potion',
        'price' => 299,
        'image' => 'null',
    ],
    [
        'code' => 'POT-HEAL-REG',
        'title' => 'Healing Potion',
        'price' => 999,
        'image' => 'null',
    ],
    [
        'code' => 'POT-HEAL-GTR',
        'title' => 'Greater Healing Potion',
        'price' => 3999,
        'image' => 'null',
    ],
    [
        'code' => 'POT-HEAL-SUP',
        'title' => 'Super Healing Potion',
        'price' => 9999,
        'image' => 'null',
    ],

    [
        'code' => 'POT-MANA-LSR',
        'title' => 'Lesser Mana Potion',
        'price' => 199,
        'image' => 'null',
    ],
    [
        'code' => 'POT-MANA-REG',
        'title' => 'Mana Potion',
        'price' => 799,
        'image' => 'null',
    ],
    [
        'code' => 'POT-MANA-GTR',
        'title' => 'Greater Mana Potion',
        'price' => 2999,
        'image' => 'null',
    ],
    [
        'code' => 'POT-MANA-SUP',
        'title' => 'Super Mana Potion',
        'price' => 8499,
        'image' => 'null',
    ],

    [
        'code' => 'POT-REST-LSR',
        'title' => 'Lesser Restoration Potion',
        'price' => 1499,
        'image' => 'null',
    ],
    [
        'code' => 'POT-REST-REG',
        'title' => 'Restoration Potion',
        'price' => 4499,
        'image' => 'null',
    ],
];

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

$repo = $container->make(\Sdr\Repository\SkuWriteRepository::class);

foreach ($skus as $sku) {
    $repo->persist(
        new \Sdr\Domain\Sku(
            \Sdr\Domain\SkuCode::create($sku['code']),
            $sku['title'],
            $sku['price'],
            null
        )
    );
}
