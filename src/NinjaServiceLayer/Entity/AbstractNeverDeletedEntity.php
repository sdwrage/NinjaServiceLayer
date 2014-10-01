<?php
/**
 * Abstract Never Deleted Entity
 *
 * Base class for entities that are never deleted.
 *
 * @package NinjaServiceLayer\Entity
 * @filesource
 */

namespace NinjaServiceLayer\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Abstract Never Deleted Entity
 *
 * Base class for entities that are never deleted.
 *
 * @package NinjaServiceLayer\Entity
 */
abstract class AbstractNeverDeletedEntity extends AbstractStandardEntity
{

    /**
     * Deleted
     *
     * @var bool Whether or not entity is deleted.
     * @ORM\Column(type="boolean")
     */
    protected $deleted = false;

    /**
     * Date Added
     *
     * @var \DateTime Date the entity was added.
     * @ORM\Column(type="datetime", name="date_added")
     */
    protected $dateAdded;

    /**
     * Date Modified
     *
     * @var \DateTime Date the entity was last modified.
     * @ORM\Column(type="datetime", name="date_modified")
     */
    protected $dateModified;

    /**
     * Get Deleted
     *
     * Gets whether or not entity is deleted.
     *
     * @return bool Whether or not entity is deleted.
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set Deleted
     *
     * Sets whether or not entity is deleted.
     *
     * @param bool $deleted Whether or not entity is deleted.
     * @return self Returns itself to allow for method chaining.
     */
    public function setDeleted($deleted = false)
    {
        $this->deleted = (bool)$deleted;
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
