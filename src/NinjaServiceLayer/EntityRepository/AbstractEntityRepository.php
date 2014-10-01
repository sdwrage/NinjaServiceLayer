<?php
/**
 * Abstract Entity Repository
 *
 * Base for entity repositories.
 *
 * @package NinjaServiceLayer\EntityRepository
 * @filesource
 */

namespace NinjaServiceLayer\EntityRepository;

use Doctrine\ORM\EntityRepository;
use InvalidArgumentException;
use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Abstract Entity Repository
 *
 * Base for entity repositories.
 *
 * @package NinjaServiceLayer\EntityRepository
 */
class AbstractEntityRepository extends EntityRepository
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
        $this->_em->remove($entity);
        $this->_em->flush();
        return $this;
    }

    /**
     * Delete By ID
     *
     * Deletes the entity with the specified ID.
     *
     * @throws InvalidArgumentException If invalid ID provided.
     * @param int $id The ID.
     * @return self Returns itself to allow for method chaining.
     */
    public function deleteById($id)
    {

        // Cleanse parameter.
        $id = (int)$id;
        if (0 === $id) throw new InvalidArgumentException('Invalid ID provided.');

        // Delete the entity.
        $entity = $this->find($id);
        $this->delete($entity);
        return $this;
    }
}
