<?php
/**
 * Abstract Entity Service
 *
 * This is an abstract class that any entity service which is used for a specific entity should extend.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer_Service
 */

namespace NinjaServiceLayer\Service;

use NinjaServiceLayer\Model\AbstractEntityModel;
use NinjaServiceLayer\Service\AbstractService;

/**
 * Abstract Entity Service
 *
 * This is an abstract class that any entity service which is used for a specific entity should extend.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer_Service
 */
class AbstractEntityService extends AbstractService
{

    /**
     * Entity
     *
     * This is the entity model that this entity model service is used with.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @var string The name of the entity model that this entity service is used with.
     */
    protected $entity = '';

    /**
     * Get All
     *
     * Get all entities for the entity model that this entity services is used with.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @return AbstractEntityModel[] Returns an array of entity models.
     */
    public function getAll()
    {
        return $this->getEntityManager()
                ->createQuery('SELECT e FROM ' . $this->entity . ' e')
                ->getResult();
    }

    /**
     * Get By ID
     *
     * Get an entity model by the provided ID.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param int $id The ID of the entity model to get.
     * @return AbstractEntityModel The entity model.
     * @throws \Exception Throw an exception if the entity wasn't found.
     */
    public function getById($id)
    {
        $entities = $this->getEntityManager()
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
     * Persists the provided model and flushes the current transaction.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param AbstractEntityModel $model The entity model to persist.
     * @return AbstractEntityService Returns the entity service to allow for method chaining.
     */
    public function persist(AbstractEntityModel $model)
    {
        $this->getEntityManager()->persist($model);
        $this->getEntityManager()->flush();
        return $this;
    }

    /**
     * Remove
     *
     * Removes the provided entity model from persistent storage and flushes the current transaction.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param AbstractEntityModel $model The model entity to remove.
     * @return AbstractEntityService Returns the entity service to allow for method chaining.
     */
    public function remove(AbstractEntityModel $model)
    {
        $this->getEntityManager()->remove($model);
        $this->getEntityManager()->flush();
        return $this;
    }

    /**
     * Get New Entity
     *
     * Get a new instance of the entity model that this entity service is used for.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @return AbstractEntityModel A new instance of the entity model that this entity service is used for.
     */
    public function getNewEntityModel()
    {
        return new $this->entity;
    }
}