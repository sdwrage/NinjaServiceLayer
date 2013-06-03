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
            'ninja_service_layer' => function ($service, $serviceManager) {
                if ($service instanceof EntityManagerAwareInterface) {
                    $service->setEntityManager($serviceManager->get('Doctrine\ORM\EntityManager'));
                }
                if ($service instanceof AbstractEntity) {
                    $serviceManager->setShared(get_class($service), false);
                }
            }
        ),
    ),
    'form_elements' => array(
        'initializers' => array(
            'ninja_service_layer' => function ($service, $formElementManager) {
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
