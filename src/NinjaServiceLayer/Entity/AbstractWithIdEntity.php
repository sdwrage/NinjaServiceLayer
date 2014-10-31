<?php
/**
 * Abstract With ID Entity
 *
 * Base class for entities with an ID column.
 *
 * @package NinjaServiceLayer\Entity
 * @filesource
 */

namespace NinjaServiceLayer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abstract With ID Entity
 *
 * Base class for entities with an ID column.
 *
 * @package NinjaServiceLayer\Entity
 */
abstract class AbstractWithIdEntity extends AbstractEntity
{
  /**
   * Id
   *
   * @var int The id.
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer", unique=true)
   */
  protected $id;

  /**
   * Get Id
   *
   * Gets the id.
   *
   * @return int The id.
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Set Id
   *
   * Sets the id.
   *
   * @param int $id The id.
   * @return self Returns itself to allow for method chaining.
   */
  public function setId($id)
  {
    $this->id = (int)$id;
    return $this;
  }
}
