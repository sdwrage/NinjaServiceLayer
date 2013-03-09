<?php

namespace NeoNinjaLib\ServiceManager;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
use NeoNinjaLib\ServiceManager\EntityManagerAwareInterface;

class DomainServiceLoaderFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        // Create our service manager that has some invokables for the domain services.
        $config = $serviceLocator->get('Configuration');
        $domainServiceManagerConfig = new Config(
            isset($config['domain_services']) ? $config['domain_services'] : array()
        );
        $domainServiceManager = new ServiceManager($domainServiceManagerConfig);

        // Add our service manager as a peering service manager.
        $serviceLocator->addPeeringServiceManager($domainServiceManager);

        // Register an initializer that will inject the Doctrine entity manager into the services.
        $domainServiceManager->addInitializer(function ($instance) use ($serviceLocator) {
            if ($instance instanceof ServiceLocatorAwareInterface) {
                $instance->setServiceLocator($serviceLocator);
            }
            if ($instance instanceof EntityManagerAwareInterface) {
                $instance->setEntityManager($serviceLocator->get('doctrine.entitymanager.orm_default'));
            }
        });

        return $domainServiceManager;
    }
}
