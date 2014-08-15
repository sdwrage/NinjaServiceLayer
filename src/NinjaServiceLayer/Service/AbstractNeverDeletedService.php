<?php
/**
 * Abstract Never Deleted Service
 *
 * A base class for services which are mainly used for working with an entity that is never delete
 *
 * @package NinjaServiceLayer\Service
 * @filesource
 */

namespace NinjaServiceLayer\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Abstract Service
 *
 * Base for all services that provides the entity manager.
 *
 * @package NinjaServiceLayer\Service
 */
abstract class AbstractNeverDeletedService extends AbstractService
{

    /**
     * Extract Not Deleted
     *
     * Creates a new collection that doesn't have the deleted ones in it.
     *
     * @param Collection|array $entities A collection of entities.
     * @return ArrayCollection The not deleted entities.
     */
    public function extractNotDeleted($entities)
    {
        $notDeletedEntities = new ArrayCollection();
        foreach ($entities as $entity) {
            if (false === $entity->getDeleted()) {
                $notDeletedEntities->add($entity);
            }
        }
        return $notDeletedEntities;
    }
}
