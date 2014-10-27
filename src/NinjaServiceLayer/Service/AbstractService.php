<?php
/**
 * Abstract Service
 *
 * Base for all services that provides the entity manager.
 *
 * @package NinjaServiceLayer\Service
 * @filesource
 */

namespace NinjaServiceLayer\Service;

use Doctrine\Common\Persistence\ObjectManager as EntityManager;
use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Abstract Service
 *
 * Base for all services that provides the entity manager.
 *
 * @package NinjaServiceLayer\Service
 */
abstract class AbstractService
{

  /**
   * Entity Manager
   *
   * @var EntityManager The doctrine entity manager.
   */
  protected $entityManager;

  /**
   * __construct
   *
   * Stores injected dependencies to properties.
   *
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
