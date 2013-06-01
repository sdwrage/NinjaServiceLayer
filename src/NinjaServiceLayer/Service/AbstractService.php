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

use Doctrine\ORM\EntityRepository;
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
abstract class AbstractService extends EntityRepository implements ServiceLocatorAwareInterface
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
}
