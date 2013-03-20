<?php
/**
 * Abstract Service
 *
 * This serves as a base class for all services in the service layer.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer_Service
 */

namespace NinjaServiceLayer\Service;

use Doctrine\ORM\EntityManager;
use NinjaServiceLayer\ServiceManager\EntityManagerAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Abstract Service
 *
 * This serves as a base class for all services in the service layer.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer_Service
 */
abstract class AbstractService implements ServiceLocatorAwareInterface, EntityManagerAwareInterface
{

    /**
     * Service Locator
     *
     * The ZF2 service locator.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @var ServiceLocatorInterface The ZF2 service locator.
     */
    protected $serviceLocator;

    /**
     * Entity Manager
     *
     * The Doctrine2 entity manager.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @var EntityManager The Doctrine2 entity manager.
     */
    protected $entityManager;

    /**
     * Set Service Locator
     *
     * Set the provided service locator to a property.
     *
     * @param ServiceLocatorInterface $serviceLocator The service locator to store.
     * @return AbstractService Returns the service to allow for method chaining.
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getService($name)
    {
        $manager = $this->getServiceLocator()->get('ServiceLoader');
        return $manager->get($name);
    }
}
