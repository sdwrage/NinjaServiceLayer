<?php
/**
 * Abstract Standard Entity
 *
 * Base class for entities with a standard ID column.
 *
 * @package NinjaServiceLayer\Entity
 * @filesource
 */

namespace NinjaServiceLayer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abstract Standard Entity
 *
 * Base class for entities with a standard ID column.
 *
 * @package NinjaServiceLayer\Entity
 */
abstract class AbstractStandardEntity extends AbstractEntity
{
    /**
     * ID
     *
     * @var int The ID.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
     */
    protected $id;

    /**
     * Get ID
     *
     * Gets the ID.
     *
     * @return int The ID.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ID
     *
     * Sets the ID.
     *
     * @param int $id The ID.
     * @return self Returns itself to allow for method chaining.
     */
    public function setId($id)
    {
        $this->id = (int)$id;
        return $this;
    }
}
