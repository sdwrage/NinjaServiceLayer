<?php
/**
 * Module Configuration
 *
 * Contains the configuration for this module.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer
 */

namespace NinjaServiceLayer;

use NinjaServiceLayer\ServiceManager\EntityManagerAwareInterface;
use NinjaServiceLayer\Entity\AbstractEntity;

return array(
    'service_manager' => array(
        'initializers' => array(
            'NinjaEntityManagerAware' => function ($service, $serviceManager) {
                if ($service instanceof EntityManagerAwareInterface) {
                    $service->setEntityManager($serviceManager->get('Doctrine\ORM\EntityManager'));
                }
                if ($service instanceof AbstractEntity) {
                    $serviceManager->setShared(get_class($service), false);
                }
            }
        ),
        'abstract_factories' => array(
            'NinjaServiceLayer\ServiceManager\EntityServiceAbstractFactory',
        ),
    ),
    'form_elements' => array(
        'initializers' => array(
            'NinjaFormEntityManagerAware' => function ($service, $formElementManager) {
                if ($service instanceof EntityManagerAwareInterface) {
                    $service->setEntityManager(
                        $formElementManager->getServiceLocator()->get('Doctrine\ORM\EntityManager')
                    );
                }
                if ($service instanceof AbstractEntity) {
                    $formElementManager->getServiceLocator()->setShared(get_class($service), false);
                }
            }
        ),
    ),
);
