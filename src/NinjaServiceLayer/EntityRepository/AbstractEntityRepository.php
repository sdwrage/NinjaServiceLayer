<?php
/**
 * Abstract Entity Repository
 *
 * Base for entity repositories.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\EntityRepository
 * @filesource
 */

namespace NinjaServiceLayer\EntityRepository;

use Doctrine\ORM\EntityRepository;
use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Abstract Entity Repository
 *
 * Base for entity repositories.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\EntityRepository
 */
class AbstractEntityRepository extends EntityRepository
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
        return $this->deleteById($entity->getId());
    }

    /**
     * Delete By ID
     *
     * Deletes the entity with the specified ID.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @throws \Exception If invalid ID provided.
     * @param int $id The ID.
     * @return self Returns itself to allow for method chaining.
     */
    public function deleteById($id)
    {

        // Cleanse parameter.
        $id = (int)$id;
        if (0 === $id) {
            throw new \Exception('Invalid ID provided.');
        }

        // Delete the entity.
        $qb = $this->_em->createQueryBuilder();
        $qb->delete($this->_entityName, 'e')
            ->where($qb->expr()->eq('e.id', ':id'))
            ->setParameter('id', $id);
        $qb->getQuery()->getResult();
        return $this;
    }
}
