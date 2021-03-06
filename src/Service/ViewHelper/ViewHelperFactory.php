<?php declare(strict_types=1);
namespace AccessResource\Service\ViewHelper;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ViewHelperFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        $class = 'AccessResource\View\Helper\\' . ucfirst($requestedName);
        $result = new $class();
        $result->setServiceLocator($serviceLocator);
        return $result;
    }
}
