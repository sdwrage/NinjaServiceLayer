<?php
/**
 * Abstract Entity Repository
 *
 * Base class for entity repositories.
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
abstract class AbstractEntityRepository extends EntityRepository
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
   * @throws InvalidArgumentException If an invalid ID was provided.
   * @param int $id The ID.
   * @return self Returns itself to allow for method chaining.
   */
  public function deleteById($id)
  {

    // Cleanse parameter.
    $id = (int)$id;
    if (0 === $id) throw new InvalidArgumentException('An invalid ID was provided.');

    // Delete the entity.
    $qb = $this->_em->createQueryBuilder();
    $qb->delete($this->_entityName, 'e')
      ->where($qb->expr()->eq('e.id', ':id'))
      ->setMaxResults(1)
      ->setParameters(array(
        'id' => $id,
      ));
    $qb->getQuery()->getResult();

    return $this;
  }
}
