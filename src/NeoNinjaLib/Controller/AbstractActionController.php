<?php

namespace NeoNinjaLib\Controller;

use Zend\Mvc\Controller\AbstractActionController as ZendAbstractActionController;

abstract class AbstractActionController extends ZendAbstractActionController
{
    public function getDomainService($serviceName)
    {
        $domainServiceLoader = $this->getServiceLocator()->get('DomainServiceLoader');
        return $domainServiceLoader->get($serviceName);
    }
}
