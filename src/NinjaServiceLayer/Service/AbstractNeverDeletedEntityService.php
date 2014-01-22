<?php
/**
 * Abstract Never Deleted Entity Service
 *
 * Base class for all entity services that mainly work with entities which are never deleted.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Service
 * @filesource
 */

namespace NinjaServiceLayer\Service;

use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Abstract Never Deleted Entity Service
 *
 * Base class for all entity services that mainly work with entities which are never deleted.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Service
 */
abstract class AbstractNeverDeletedEntityService extends AbstractEntityService
{

    /**
     * Get New Entity
     *
     * Gets a new entity.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @return AbstractEntity The new entity.
     */
    public function getNewEntity()
    {
        $entity = parent::getNewEntity();
        $entity->setDateAdded(new \DateTime())
            ->setDateModified(new \DateTime())
            ->setDeleted(false);
        return $entity;
    }

    /**
     * Persist
     *
     * Saves the entity provided.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param AbstractEntity $entity The entity to save.
     * @return self Returns itself to allow for method chaining.
     */
    public function persist(AbstractEntity $entity)
    {
        $entity->setDateModified(new \DateTime());
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $this;
    }
}
