<?php
/**
 * Entity Manager Aware Interface
 *
 * This is an interface for classes that are aware of Doctrine2's entity manager.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer\ServiceManager
 */

namespace NinjaServiceLayer\ServiceManager;

use Doctrine\ORM\EntityManager;

/**
 * Entity Manager Aware Interface
 *
 * This is an interface for classes that are aware of Doctrine2's entity manager.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer\ServiceManager
 */
interface EntityManagerAwareInterface
{
    public function setEntityManager(EntityManager $entityManager);
    public function getEntityManager();
}