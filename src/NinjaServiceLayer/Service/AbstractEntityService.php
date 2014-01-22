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
use NinjaServiceLayer\Entity\Factory\FactoryInterface as EntityFactory;

/**
 * Abstract Entity Service
 *
 * Base service that services which mainly work with one entity (AKA an entity service) should be based off of.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Service
 */
abstract class AbstractEntityService
{

    /**
     * Entity Factory
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @var EntityFactory The entity factory.
     */
    protected $entityFactory;

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
     * @param EntityFactory $entityFactory The entity factory for the entity that this entity service mainly works with.
     * @param EntityManager $entityManager The doctrine entity manager.
     */
    public function __construct(EntityFactory $entityFactory, EntityManager $entityManager)
    {
        $this->entityFactory = $entityFactory;
        $this->entityManager = $entityManager;
    }

    /**
     * Get New Entity
     *
     * Gets a new entity for use.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @return AbstractEntity The new entity.
     */
    public function getNewEntity()
    {
        return $this->entityFactory->createEntity();
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
