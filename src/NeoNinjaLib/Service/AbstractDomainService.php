<?php

namespace NeoNinjaLib\Service;

use Doctrine\ORM\EntityManager;
use NeoNinjaLib\ServiceManager\EntityManagerAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractDomainService implements ServiceLocatorAwareInterface, EntityManagerAwareInterface
{
    protected $serviceLocator;
    protected $entityManager;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLoator = $serviceLocator;
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

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getDomainService($serviceName)
    {
        $manager = $this->getServiceLocator()->get('DomainServiceLoader');
        return $manager->get($serviceName);
    }
}
