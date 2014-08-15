<?php
/**
 * Abstract Never Deleted Entity Repository
 *
 * Base entity repository for entity repositories for never deleted entities.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
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
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\EntityRepository
 */
abstract class AbstractNeverDeletedEntityRepository extends AbstractEntityRepository
{

    /**
     * Delete
     *
     * Deletes the provided entity.
     *
     * @author Daniel Del Rio <daniel@aelarn.com>
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

    /**
     * Get Not Deleted
     *
     * Gets the not deleted entities.
     *
     * @return array The not deleted entities.
     */
    public function getNotDeleted()
    {
        return $this->findBy(array('deleted' => 0));
    }
}
