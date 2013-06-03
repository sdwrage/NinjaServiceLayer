<?php

namespace NinjaServiceLayer\Form;

use Doctrine\ORM\EntityManager;
use NinjaServiceLayer\ServiceManager\EntityManagerAwareInterface;
use Zend\Form\Fieldset;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractFieldset extends Fieldset implements ServiceLocatorAwareInterface, EntityManagerAwareInterface
{
    protected $serviceLocator;

    protected $entityManager;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        if ('Zend\Form\FormElementManager' === get_class($serviceLocator)) {
            $serviceLocator = $serviceLocator->getServiceLocator();
        }
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }
}
