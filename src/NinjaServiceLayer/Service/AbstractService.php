<?php
/**
 * Abstract Service
 *
 * This serves as a base class for all services in the service layer.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer\Service
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
 * @package NinjaServiceLayer\Service
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
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param ServiceLocatorInterface $serviceLocator The service locator to store.
     * @return AbstractService Returns the service to allow for method chaining.
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Get Service Locator
     *
     * Get the service locator.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @return ServiceLocatorInterface The service locator.
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Set Entity Manager
     *
     * Set the Doctrine2 entity manager to a property.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param EntityManager $entityManager The Doctrine2 entity manager.
     * @return AbstractService Returns the service to allow for method chaining.
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * Get Entity Manager
     *
     * Get the Doctrine2 entity manager.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @return EntityManager The Doctrine2 entity manager.
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
}