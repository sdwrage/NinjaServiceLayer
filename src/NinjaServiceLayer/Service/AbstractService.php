<?php
/**
 * Abstract Service
 *
 * Base for all services that provides the entity manager.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Service
 * @filesource
 */

namespace NinjaServiceLayer\Service;

use Doctrine\ORM\EntityManager;
use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Abstract Service
 *
 * Base for all services that provides the entity manager.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Service
 */
abstract class AbstractService
{

    /**
     * Entity Manager
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @var EntityManager The doctrine entity manager.
     */
    protected $entityManager;

    /**
     * __construct
     *
     * Stores dependencies to properties.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param EntityManager $entityManager The doctrine entity manager.
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Persist
     *
     * Saves the provided entity.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param AbstractEntity $entity The entity to save.
     * @return self Returns itself to allow for method chaining.
     */
    public function persist(AbstractEntity $entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $this;
    }
}
