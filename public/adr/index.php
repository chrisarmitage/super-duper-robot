<?php

require __DIR__ . '/../../vendor/autoload.php';

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Framework\App;
use Symfony\Component\HttpFoundation\Request;

ini_set('display_errors', true);

$request = Request::createFromGlobals();

$container = new \Auryn\Injector();

$container->share($container);
$container->share($request);

$container->share(
    (new \Framework\Router\RegexRouter('Application\\Adr\\Action\\'))
        ->addRoute('/orders', 'Orders\\Index')
        ->addRoute('/orders/create', 'Orders\\Create')
        ->addRoute('/orders/view/{id}', 'Orders\\View')
        ->addRoute('/orders/view/{id}/dispatch', 'Orders\\Dispatch')
        ->addRoute('/skus', 'Skus\\Index')
        ->addRoute('/skus/view/{code}', 'Skus\\View')
        ->addRoute('/basket/add/{code}', 'Basket\\Add')
        ->addRoute('/basket/remove/{basketItemId}', 'Basket\\Remove')
        ->addRoute('/checkout', 'Checkout')
        ->addRoute('/customer/sign-up', 'Customer\\SignUp')
);

$container->alias(\Framework\Router::class, \Framework\Router\RegexRouter::class);

/**
 * Initialise DB connection
 */
$dbh = new \PDO('sqlite:' . __DIR__ . '/../../build/db.sqlite');
$dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$container->share($dbh);

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

/**
 * Initialise Twig
 */
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../templates');
$twig = new \Twig\Environment($loader, ['debug' => true]);
$twig->addExtension(new \Twig\Extension\DebugExtension());
$container->share($twig);

/**
 * Process the request
 */
session_start();

$app = $container->make(App::class);

$response = $app->processRequest($request);

$response->send();
