<?php
/**
 * Abstract Entity
 *
 * Base class for entities.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Entity
 * @filesource
 */

namespace NinjaServiceLayer\Entity;

/**
 * Abstract Entity
 *
 * Base class for entities.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Entity
 */
class AbstractEntity
{
    /**
     * ID
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @var int The ID.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
     */
    protected $id;

    /**
     * __construct
     *
     * Stores provided options to properties.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param null|array $options The options to store.
     */
    public function __construct(array $options = null)
    {
        if (null !== $options && count($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * __get
     *
     * Allows getting of protected properties.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @throws \Exception If property to get doesn't exist.
     * @param string $propertyName The name of the property to get.
     * @return mixed The value of the property.
     */
    public function __get($propertyName)
    {
        $methodName = 'get' . ucfirst($propertyName);
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        }
        throw new \Exception('Property does not exist.');
    }

    /**
     * __set
     *
     * Allows setting of protected properties.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @throws \Exception If property to set doesn't exist.
     * @param string $propertyName The name of the property to set.
     * @param mixed $propertyValue The value to set to the property.
     */
    public function __set($propertyName, $propertyValue)
    {
        $methodName = 'set' . ucfirst($propertyName);
        if (!method_exists($this, $methodName)) {
            throw new \Exception('Property does not exist.');
        }
        $this->$methodName($propertyValue);
    }

    /**
     * Set Options
     *
     * Stores provided options to properties.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param null|array $options The options to store.
     * @return self Returns itself to allow for method chaining.
     */
    public function setOptions(array $options = null)
    {
        if (null !== $options && count($options) {
            foreach ($options as $propertyName => $propertyValue) {
                $this->$propertyName = $propertyValue;
        }
        return $this;
    }

    /**
     * Get ID
     *
     * Gets the ID.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
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
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param int $id The ID.
     * @return self Returns itself to allow for method chaining.
     */
    public function setId($id)
    {
        $this->id = (int)$id;
        return $this;
    }
}
