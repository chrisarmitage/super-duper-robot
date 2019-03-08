<?php

namespace Sdr;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Sdr\Domain\SessionId;

class DoctrineSessionId extends GuidType
{
    public function getName()
    {
        return 'SessionId';
    }

    /**
     * @param SessionId  $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string) $value;
    }

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     * @return mixed|SessionId
     * @throws \Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new SessionId($value);
    }
}
