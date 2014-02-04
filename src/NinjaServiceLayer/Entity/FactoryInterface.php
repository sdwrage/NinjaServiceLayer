<?php
/**
 * Factory Interface
 *
 * Interface that entity factories must implement.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Entity
 * @filesource
 */

namespace NinjaServiceLayer\Entity;

use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Factory Interface
 *
 * Interface that entity factories must implement.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Entity
 */
interface FactoryInterface
{

    /**
     * Create Entity
     *
     * Creates the entity.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @return AbstractEntity The entity.
     */
    public function createEntity();
}
