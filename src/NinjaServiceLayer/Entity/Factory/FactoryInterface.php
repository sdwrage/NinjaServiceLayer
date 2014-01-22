<?php
/**
 * Factory Interface
 *
 * Interface that entity factories must implement.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Entity\Factory
 * @filesource
 */

namespace NinjaServiceLayer\Entity\Factory

use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Factory Interface
 *
 * Interface that entity factories must implement.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Entity\Factory
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
