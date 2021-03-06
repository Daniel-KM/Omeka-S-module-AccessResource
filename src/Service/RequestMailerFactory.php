<?php declare(strict_types=1);

namespace AccessResource\Service;

use AccessResource\Mail\RequestMailer;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class RequestMailerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new RequestMailer($services);
    }
}
