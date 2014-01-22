<?php
/**
 * Abstract Entity Service
 *
 * Base service that services which mainly work with one entity (AKA an entity service) should be based off of.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Service
 * @filesource
 */

namespace NinjaServiceLayer\Service;

use Doctrine\ORM\EntityManager;
use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Abstract Entity Service
 *
 * Base service that services which mainly work with one entity (AKA an entity service) should be based off of.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Service
 * @filesource
 */
class AbstractEntityService
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
