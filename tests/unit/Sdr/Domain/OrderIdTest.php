<?php

use PHPUnit\Framework\TestCase;

class OrderIdTest extends TestCase
{
    public function testCreatesIdFromString(): void
    {
        $id = \Sdr\Domain\OrderId::create('my-string');

        self::assertEquals('my-string', (string) $id);
    }

    public function testCreatesIdFromNull(): void
    {
        $id = \Sdr\Domain\OrderId::create(null);

        self::assertEquals(36, strlen((string) $id));
    }
}
