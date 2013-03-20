<?php
/**
 * Abstract Action Controller
 *
 * This is an abstract class that all controllers can extend. It will endow the controller with ways to make use of the
 * service layer.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer_Controller
 */

namespace NinjaServiceLayer\Controller;

use Zend\Mvc\Controller\AbstractActionController as ZendAbstractActionController;

/**
 * Abstract Action Controller
 *
 * This is an abstract class that all controllers can extend. It will endow the controller with ways to make use of the
 * service layer.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer_Controller
 */
abstract class AbstractActionController extends ZendAbstractActionController
{

    /**
     * Get Service
     *
     * This method is used to get the service specified by the service name provided.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param string $name The name of the service to get.
     * @return NinjaServiceLayer\Service\AbstractService The service that was asked for.
     */
    public function getService($name)
    {
        $serviceLoader = $this->getServiceLocator()->get('ServiceLoader');
        return $serviceLoader->get($name);
    }
}
