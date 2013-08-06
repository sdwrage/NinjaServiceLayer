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

use Doctrine\ORM\EntityRepository;
use NinjaServiceLayer\Entity\AbstractEntity;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Abstract Entity Service
 *
 * This is an abstract class that any entity service which is used for a specific entity should extend.
 *
 * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
 * @package NinjaServiceLayer\Service
 */
class AbstractEntityService extends EntityRepository implements ServiceLocatorAwareInterface
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
     * Service Locator
     *
     * The ZF2 service locator.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @var ServiceLocatorInterface The ZF2 service locator.
     */
    protected $serviceLocator;

    /**
     * Set Service Locator
     *
     * Set the provided service locator to a property.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @param ServiceLocatorInterface $serviceLocator The service locator to store.
     * @return AbstractService Returns the service to allow for method chaining.
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Get Service Locator
     *
     * Get the service locator.
     *
     * @author Daniel Del Rio <jesusfreakdelrio@gmail.com>
     * @return ServiceLocatorInterface The service locator.
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Get All
     *
     * Get all entities.
     *
     * @param array $order The order specification. Should have two keys: column, direction
     * @return AbstractEntity[] An array of all the entities.
     */
    public function getAll(array $order = null)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
           ->from($this->entity, 'e');

        if (null !== $order) {
            if (array_key_exists('column', $order)) {
                $direction = 'ASC';
                if (array_key_exists('direction', $order)) {
                    $direction = $order['direction'];
                }
                $qb->orderBy($order['column'], $direction);
            }
        }

        return $qb->getQuery()->getResult();
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

    public function getByIds(array $ids)
    {
        $query = 'SELECT e FROM ' . $this->entity . ' e WHERE e.id = ' . (int)array_shift($ids);
        foreach ($ids as $id) {
            $query .= ' OR e.id = ' . (int)$id;
        }

        $entities = $this->_em
                         ->createQuery($query)
                         ->getResult();
        return $entities;
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

    public function bindEntityToForm(Form $form, AbstractEntity $entity = null)
    {
        if (null === $entity) {
            $entity = $this->getNewEntity();
        }
        $form->bind($entity);
        return $entity;
    }
}
