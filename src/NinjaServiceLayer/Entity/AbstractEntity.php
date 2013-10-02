<?php
/**
 * Abstract Entity
 *
 * A base class for all entities.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Entity
 * @filesource
 */

namespace NinjaServiceLayer\Entity;

/**
 * Abstract Entity
 *
 * A base class for all entities.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Entity
 */
class AbstractEntity
{

    /**
     * Constructor
     *
     * Will store the provided options to properties if possible.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param null|array $options An array of options that should be stored to properties. The key should be the name of the property and the value should be the value to set the property to.
     */
    public function __construct($options = array())
    {
        $this->setOptions($options);
    }

    /**
     * Magic Getter
     *
     * Allows you access a protected and private properties as if they were public. This ensures that the getter for the
     * property is always used just incase anthing needs to be done like lazy-loading.
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
        } else {
            throw new \Exception('Attempting to get an invalid property.');
        }
    }

    /**
     * Magic Setter
     *
     * Allows you to store values to the protected properties of this entity as if they were public. This will actually
     * use a setter allowing us to perform any needed actions on the value before storing it.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @throws \Exception If property to set doesn't exist.
     * @param string $propertyName The name of the property to set.
     * @param mixed $propertyValue The value to set to the property.
     * @return self Returns itself to allow for a fluent interface.
     */
    public function __set($propertyName, $propertyValue)
    {
        $methodName = 'set' . ucfirst($propertyName);
        if (method_exists($this, $methodName)) {
            $this->$methodName($propertyValue);
            return $this;
        } else {
            throw new \Exception('Attempting to set an invalid property.');
        }
    }

    /**
     * Set Options
     *
     * Will store the provided options to properties if possible.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param null|array $options An array of options that should be stored to properties. The key should be the name of the property and the value should be the value to set the property to.
     * @return self Returns itself to allow for method chaining.
     */
    public function setOptions($options = array())
    {
        foreach ($options as $propertyName => $propertyValue) {
            $methodName = 'set' . ucfirst($propertyName);
            if (method_exists($this, $methodName)) {
                $this->$methodName($propertyValue);
            }
        }
        return $this;
    }

    /**
     * Get Array Copy
     *
     * Get an array representation of this instance.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @return array An array representation of this instance.
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}