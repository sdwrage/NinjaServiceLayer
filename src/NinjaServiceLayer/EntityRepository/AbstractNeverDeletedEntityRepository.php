<?php
/**
 * Abstract Never Deleted Entity Repository
 *
 * Base entity repository for entity repositories for never deleted entities.
 *
 * @package NinjaServiceLayer\EntityRepository
 * @filesource
 */

namespace NinjaServiceLayer\EntityRepository;

use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Abstract Never Deleted Entity Repository
 *
 * Base entity repository for entity repositories for never deleted entities.
 *
 * @package NinjaServiceLayer\EntityRepository
 */
abstract class AbstractNeverDeletedEntityRepository extends AbstractEntityRepository
{

    /**
     * Delete
     *
     * Deletes the provided entity.
     *
     * @param AbstractEntity $entity The entity to delete.
     * @return self Returns itself to allow for method chaining.
     */
    public function delete(AbstractEntity $entity)
    {
        $entity->setDeleted(true);
        $this->_em->persist($entity);
        $this->_em->flush();
        return $this;
    }
}
