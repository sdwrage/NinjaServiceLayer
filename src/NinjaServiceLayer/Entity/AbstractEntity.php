<?php
/**
 * Abstract Entity
 *
 * Base class for entities.
 *
 * @package NinjaServiceLayer\Entity
 * @filesource
 */

namespace NinjaServiceLayer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abstract Entity
 *
 * Base class for entities.
 *
 * @package NinjaServiceLayer\Entity
 */
abstract class AbstractEntity
{

    /**
     * __construct
     *
     * Stores provided options to properties.
     *
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
     * @param null|array $options The options to store.
     * @return self Returns itself to allow for method chaining.
     */
    public function setOptions(array $options = null)
    {
        if (null !== $options && count($options)) {
            foreach ($options as $propertyName => $propertyValue) {
                $this->$propertyName = $propertyValue;
            }
        }
        return $this;
    }
}
