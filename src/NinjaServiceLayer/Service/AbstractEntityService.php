<?php
/**
 * Abstract Entity Service
 *
 * This is an abstract class that any entity service which is used for a specific entity should extend.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer\Service
 */

namespace NinjaServiceLayer\Service;

use NinjaServiceLayer\Service\AbstractService;
use NinjaServiceLayer\Entity\AbstractEntity;

/**
 * Abstract Entity Service
 *
 * This is an abstract class that any entity service which is used for a specific entity should extend.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer\Service
 */
class AbstractEntityService extends AbstractService
{

    /**
     * Entity
     *
     * The name of the entity that this entity service is used with.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @var string The name of the entity that this entity service is used with.
     */
    protected $entity = '';

    /**
     * Get All
     *
     * Get all entities.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @return AbstractEntity[] An array of all the entities.
     */
    public function getAll()
    {
        return $this->_em
                    ->createQuery('SELECT e FROM ' . $this->entity . ' e')
                    ->getResult();
    }

    /**
     * Get By ID
     *
     * Get the entity with the specified ID.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param int $id The ID of the entity that should be gotten.
     * @return AbstractEntity The entity with the specified ID.
     * @throws \Exception Throw an exception if the entity wasn't found.
     */
    public function getById($id)
    {
        $entities = $this->_em
                         ->createQuery('SELECT e FROM ' . $this->entity . ' e WHERE e.id = :id')
                         ->setParameter('id', $id)
                         ->getResult();
        if (!count($entities)) {
            throw new \Exception($this->entity . ' not found with id: ' . $id);
        }
        return $entities[0];
    }

    /**
     * Persist
     *
     * Persists the provided entity.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param AbstractEntity $model The entity to persist.
     * @return AbstractEntityService Returns the entity service to allow for method chaining.
     */
    public function persist(AbstractEntity $model)
    {
        $this->_em->persist($model);
        $this->_em->flush();
        return $this;
    }

    /**
     * Remove
     *
     * Removes the provided entity from persistent storage.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param AbstractEntity $model The entity to remove.
     * @return AbstractEntityService Returns the entity allow for method chaining.
     */
    public function remove(AbstractEntity $model)
    {
        $this->_em->remove($model);
        $this->_em->flush();
        return $this;
    }

    /**
     * Get New Entity
     *
     * Get a new instance of the entity that this entity service is used for.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @return AbstractEntity A new instance of the entity that this entity service is used for.
     */
    public function getNewEntity()
    {
        return $this->getServiceLocator()->get($this->entity);
    }
}
