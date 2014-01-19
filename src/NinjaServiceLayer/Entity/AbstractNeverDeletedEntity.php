<?php
/**
 * Abstract Never Deleted Entity
 *
 * Base class for entities that are never deleted.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Entity
 * @filesource
 */

namespace NinjaServiceLayer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abstract Never Deleted Entity
 *
 * Base class for entities that are never deleted.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Entity
 */
abstract class AbstractNeverDeletedEntity extends AbstractEntity
{

    /**
     * Deleted
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @var bool Whether or not entity is deleted.
     * @ORM\Column(type="boolean")
     */
    protected $deleted = false;

    /**
     * Date Added
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @var \DateTime Date the entity was added.
     * @ORM\Column(type="datetime", name="date_added")
     */
    protected $dateAdded;

    /**
     * Date Modified
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @var \DateTime Date the entity was last modified.
     * @ORM\Column(type="datetime", name="date_modified")
     */
    protected $dateModified;

    /**
     * Get Deleted
     *
     * Gets whether or not entity is deleted.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
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
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
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
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @return \DateTime The date the entity was added.
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
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param \DateTime $dateAdded The date the entity was added.
     * @return self Returns itself to allow for method chaining.
     */
    public function setDateAdded(\DateTime $dateAdded = null)
    {
        if (null === $dateAdded) {
            $dateAdded = new \DateTime();
        }
        $this->dateAdded = $dateAdded;
        return $this;
    }

    /**
     * Get Date Modified
     *
     * Gets the date the entity was last modified.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @return \DateTime The date the entity was last modified.
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
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param \DateTime $dateModified The date the entity was last modified.
     * @return self Returns itself to allow for method chaining.
     */
    public function setDateModified(\DateTime $dateModified = null)
    {
        if (null === $dateModified) {
            $dateModified = new \DateTime();
        }
        $this->dateModified = $dateModified;
        return $this;
    }
}
