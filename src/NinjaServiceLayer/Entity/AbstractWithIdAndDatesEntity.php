<?php
/**
 * Abstract With ID And Dates Entity
 *
 * Base class for entities with an ID column.
 *
 * @package NinjaServiceLayer\Entity
 * @filesource
 */

namespace NinjaServiceLayer\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Abstract With ID And Dates Entity
 *
 * Base class for entities with an ID column.
 *
 * @package NinjaServiceLayer\Entity
 */
abstract class AbstractWithIdAndDatesEntity extends AbstractEntity
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
   * Date Added
   *
   * @var DateTime Date the entity was added.
   * @ORM\Column(type="datetime", name="date_added")
   */
  protected $dateAdded;

  /**
   * Date Modified
   *
   * @var DateTime Date the entity was last modified.
   * @ORM\Column(type="datetime", name="date_modified")
   */
  protected $dateModified;

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

  /**
   * Get Date Added
   *
   * Gets the date the entity was added.
   *
   * @return DateTime The date the entity was added.
   */
  public function getDateAdded()
  {
    return $this->dateAdded;
  }

  /**
   * Set Date Added
   *
   * Sets the date the entity was added.
   *
   * @param DateTime $dateAdded The date the entity was added.
   * @return self Returns itself to allow for method chaining.
   */
  public function setDateAdded(DateTime $dateAdded = null)
  {
    if (null === $dateAdded) {
      $dateAdded = new DateTime;
    }
    $this->dateAdded = $dateAdded;
    return $this;
  }

  /**
   * Get Date Modified
   *
   * Gets the date the entity was last modified.
   *
   * @return DateTime The date the entity was last modified.
   */
  public function getDateModified()
  {
    return $this->dateModified;
  }

  /**
   * Set Date Modified
   *
   * Sets the date the entity was last modified.
   *
   * @param DateTime $dateModified The date the entity was last modified.
   * @return self Returns itself to allow for method chaining.
   */
  public function setDateModified(DateTime $dateModified = null)
  {
    if (null === $dateModified) {
      $dateModified = new DateTime;
    }
    $this->dateModified = $dateModified;
    return $this;
  }
}
