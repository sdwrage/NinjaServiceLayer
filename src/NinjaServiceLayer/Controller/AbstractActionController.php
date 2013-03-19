<?php
/**
 * Abstract Action Controller
 *
 * This is an abstract class that all controllers can extend. It will endow the controller with a way to get one of your
 * domain services.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer_Controller
 */

namespace NinjaServiceLayer\Controller;

use Zend\Mvc\Controller\AbstractActionController as ZendAbstractActionController;

/**
 * Abstract Action Controller
 *
 * This is an abstract class that all controllers can extend. It will endow the controller with a way to get one of your
 * domain services.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer_Controller
 */
abstract class AbstractActionController extends ZendAbstractActionController
{

    /**
     * Get Domain Service
     *
     * This method is used to get the domain service specified by the service name provided.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param string $serviceName The name of the service to get.
     * @return mixed
     */
    public function getDomainService($serviceName)
    {
        $domainServiceLoader = $this->getServiceLocator()->get('DomainServiceLoader');
        return $domainServiceLoader->get($serviceName);
    }
}