<?php
/**
 * Factory Interface
 *
 * Interface that entity factories must implement.
 *
 * @package NinjaServiceLayer\Entity
 * @filesource
 */

namespace NinjaServiceLayer\Entity;

use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Factory Interface
 *
 * Interface that entity factories must implement.
 *
 * @package NinjaServiceLayer\Entity
 */
interface FactoryInterface
{

  /**
   * Create Entity
   *
   * Creates the entity.
   *
   * @return AbstractEntity The entity.
   */
  public function createEntity();
}
