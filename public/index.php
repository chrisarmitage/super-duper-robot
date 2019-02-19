<?php

require __DIR__ . '/../vendor/autoload.php';

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Framework\App;
use Framework\Router\RestActionRouter;
use Symfony\Component\HttpFoundation\Request;

ini_set('display_errors', true);

$request = Request::createFromGlobals();

$container = new \Auryn\Injector();

$container->share($container);

$container->share(new RestActionRouter(null));

$container->alias(\Framework\Router::class, RestActionRouter::class);

/**
 * Initialise DB connection
 */
$dbh = new \PDO('sqlite:' . __DIR__ . '/../build/db.sqlite');
$dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$container->share($dbh);

/**
 * Initialise Doctrine
 */
Type::addType(
    'OrderId',
    \Sdr\DoctrineOrderId::class
);

$config = Setup::createXMLMetadataConfiguration(
    [ __DIR__ . '/../src/Sdr/Domain/doctrine-entities'],
    false
);
$entityManager = EntityManager::create(
    [
        'driver' => 'pdo_sqlite',
        'path' =>  __DIR__ . '/../build/db.sqlite',
    ],
    $config
);

$container->share($entityManager);
$container->alias(\Doctrine\ORM\EntityManagerInterface::class, EntityManager::class);

$app = $container->make(App::class);

$response = $app->processRequest($request);

$response->send();
