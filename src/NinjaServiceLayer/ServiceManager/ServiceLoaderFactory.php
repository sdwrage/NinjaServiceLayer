<?php
/**
 * Service Loader Factory
 *
 * This is a factory for loading the services.
 *
 * @author Daniel Del Rio <daniel@aelearn.com>
 * @package NinjaServiceLayer_ServiceManager
 */

namespace NinjaServiceLayer\ServiceManager;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
use NinjaServiceLayer\ServiceManager\EntityManagerAwareInterface;

/**
 * Service Loader Factory
 *
 * This is a factory for loading the services.
 *
 * @author Daniel Del Rio <daniel@aelearn.com>
 * @package NinjaServiceLayer_ServiceManager
 */
class DomainServiceLoaderFactory implements FactoryInterface
{

    /**
     * Create Service
     *
     * This method is demanded by FactoryInterface. We use it to add our own peering service manager to ZF2's service
     * manager. Our peering service manager will add an initializer that will inject and services which implement the
     * EntityManagerAwareInterface with Doctrine2's entity manager.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param ServiceLocatorInterface $serviceLocator The ZF2 service locator.
     * @return ServiceManager Return the peering service manager.
     */
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