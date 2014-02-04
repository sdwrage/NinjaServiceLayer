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
        $qb->update($this->_entityName, 'e')
            ->set('e.deleted', ':deleted')
            ->set('e.dateModified', ':dateModified')
            ->where($qb->expr()->eq('e.id', ':id'))
            ->setParameters(
                array(
                    'deleted' => 1,
                    'dateModified' => date('Y-m-d H:i:s'),
                    'id' => $id,
                )
            );
        $qb->getQuery()->getResult();
        return $this;
    }
}
