<?php

namespace NinjaServiceLayer\ServiceManager;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\AbstractFactoryInterface;

class EntityServiceAbstractFactory implements AbstractFactoryInterface
{
    protected $entityServicePattern = '/^(.*)EntityService$/';

    protected function getEntityServiceName($requestedName)
    {
        $matches = array();
        if (preg_match($this->entityServicePattern, $requestedName, $matches)) {
            return $matches[1];
        }
        return false;
    }

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $serviceName = $this->getEntityServiceName($requestedName);
        if (false !== $serviceName && class_exists('\\' . $serviceName)) {
            return true;
        }
        return false;
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $serviceName = $this->getEntityServiceName($requestedName);
        return $serviceLocator->get('Doctrine\ORM\EntityManager')->getRepository(
            str_replace('Service', 'Entity', $serviceName)
        );
    }
}