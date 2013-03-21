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
                    $service->setEntityManager($serviceManager->get('doctrine.entitymanager.orm_default'));
                }
                if ($service instanceof AbstractEntity) {
                    $serviceManager->setShared(get_class($service), false);
                }
            }
        ),
    ),
);