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
     *
     * @ORM\Column(name="id", type="integer", nullable=false, unique=true, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * Set ID
     *
     * Sets the ID.
     *
     * @param int $id The ID.
     * @return AbstractStandardEntity Returns itself to allow for method chaining.
     */
     public function setId($id)
     {
         $this->id = (int)$id;
         return $this;
     }


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
}
