<?php
/**
 * Abstract Entity Model
 *
 * An abstract class that all entity models can extend.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer_Model
 */

namespace NinjaServiceLayer\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abstract Entity Model
 *
 * An abstract class that all entity models can extend.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer_Model
 */
abstract class AbstractEntityModel extends AbstractModel
{
    /**
     * Id
     *
     * Primary identifier in the database of this entity.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     */
    protected $id;

    /**
     * Set ID
     *
     * Set the ID of the model.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param int $id The ID of the model.
     * @return AbstractEntityModel Returns itself to allow for method chaining.
     */
    public function setId($id)
    {
        $this->id = (int)$id;
        return $this;
    }

    /**
     * Get ID
     *
     * Get the ID of the model.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @return null|int The ID of the model.
     */
    public function getId()
    {
        return $this->id;
    }
}