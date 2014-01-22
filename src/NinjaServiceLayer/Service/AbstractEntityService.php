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
     * Delete
     *
     * Deletes the entity provided.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param AbstractEntity $entity The entity to delete.
     * @return self Returns itself to allow for method chaining.
     */
    public function delete(AbstractEntity $entity)
    {
        $this->entityManager->getRepository($this->entity)->delete($entity);
        return $this;
    }

    /**
     * Delete By ID
     *
     * Deletes the entity with the ID provided.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param int $id The ID of the entity to delete.
     * @return self Returns itself to allow for method chaining.
     */
    public function deleteById($id)
    {
        $this->entityManager->getRepository($this->entity)->deleteById($id);
        return $this;
    }

    /**
     * Find
     *
     * Gets the entity with the provided ID.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param int $id The ID of the entity to get.
     * @return AbstractEntity The entity.
     */
    public function find($id)
    {
        return $this->entityManager->getRepository($this->entity)->find($id);
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
