<?php
/**
 * Abstract Entity Service
 *
 * A base class for all entity services. An entity service is a special type of service that is intended to mainly work
 * with a single entity.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Service
 * @filesource
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
 * A base class for all entity services. An entity service is a special type of service that is intended to mainly work
 * with a single entity.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer\Service
 */
class AbstractEntityService extends EntityRepository implements ServiceLocatorAwareInterface
{

    /**
     * Service Locator
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @var ServiceLocatorInterface The service locator.
     */
    protected $serviceLocator;

    /**
     * Bind Entity To Form
     *
     * Bind the specified entity to the specified form. If no entity was specified then a new one will be created.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param Form $form The form to bind to.
     * @param null|AbstractEntity $entity The entity to bind to the form.
     * @return AbstractEntity The entity that was bound to the form.
     */
    public function bindEntityToForm(Form $form, AbstractEntity $entity = null)
    {
        if (null === $entity) {
            $entity = $this->getNewEntity();
        }
        $form->bind($entity);
        return $entity;
    }

    /**
     * Delete By ID
     *
     * This will delete an entity by ID provided.
     *
     * @param int $id The ID of the entity to delete.
     * @return AbstractEntity The entity that was deleted.
     */
    public function deleteById($id)
    {
        $entity = $this->getById($id);
        $entity->setDeleted(1)
            ->setDateModified();
        $this->persist($entity);
        return $entity;
    }

    /**
     * Get All
     *
     * Get all entities.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param string $sortProperty The property to sort the courses by.
     * @param string $sortDirection The direction to sort the entities in.
     * @return AbstractEntity[] An array of all the entities.
     */
    public function getAll($sortProperty = 'id', $sortDirection = 'ascending')
    {

        // Cleanse parameters.
        $sortProperty = trim((string)$sortProperty);
        if ('' === $sortProperty) $sortProperty = 'id';
        $sortDirection = trim((string)$sortDirection);
        if ('' === $sortDirection) $sortDirection = 'ascending';

        // Get the entities.
        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
            ->from($this->entity, 'e')
            ->where($qb->expr()->eq('e.deleted', ':deleted'))
            ->setParameters(
                array(
                    'deleted' => 0,
                )
            );
        $entities = $qb->getQuery()->getResult();
        return $this->sortEntitiesByProperty($entities, $sortProperty, $sortDirection);
    }

    /**
     * Get By ID
     *
     * Get the entity with the specified ID.
     *
     * @param int $id The ID of the entity that should be gotten.
     * @return AbstractEntity The entity with the specified ID.
     * @throws \Exception Throw an exception if the entity wasn't found.
     */
    public function getById($id)
    {
        $query = $this->_em
            ->createQuery('SELECT e FROM ' . $this->entity . ' e WHERE e.id = :id')
            ->setParameter('id', $id);

        $entities = $query->getResult();

        if (!count($entities)) {
            throw new \Exception($this->entity . ' not found with id: ' . $id);
        }

        return $entities[0];
    }

    /**
     * Get By IDs
     *
     * Get a list of entities by their ID.
     *
     * @param array $ids The IDs of the entities to get.
     * @return AbstractEntity[] The entities.
     */
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
     * Get New Entity
     *
     * Get a new instance of the entity that this entity service is used for.
     *
     * @return AbstractEntity A new instance of the entity that this entity service is used for.
     */
    public function getNewEntity()
    {
        return $this->getServiceLocator()->get($this->entity);
    }

    /**
     * Get Not Deleted
     *
     * Gets all not deleted entities, ordered by id if not specified.
     *
     * @param string $sort The ordering expression.
     * @param string $order The ordering direction.
     * @return AbstractEntity[] An array of all not deleted entities.
     */
    public function getNotDeleted($sort = 'id', $order = 'ASC')
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
            ->from($this->entity, 'e')
            ->where($qb->expr()->neq('e.deleted', true))
            ->orderBy('e.'.$sort, $order);
        return $qb->getQuery()->getResult();
    }

    /**
     * Get Not Deleted By User ID
     *
     * Get the not deleted role assignments for the specified user.
     *
     * @param array $params The parameters to search by.
     * @param array $order The order for the results.
     * @return RoleAssignmentEntity[] The role assignments for the specified user.
     */
    public function getNotDeletedBy(array $params, array $order)
    {
        return $this->findBy(array_merge(array('deleted' => false), $params), $order);
    }

    /**
     * Get Service Locator
     *
     * Get the service locator.
     *
     * @return ServiceLocatorInterface The service locator.
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Persist
     *
     * Persists the provided entity.
     *
     * @param AbstractEntity $model The entity to persist.
     * @return AbstractEntityService Returns the entity service to allow for method chaining.
     */
    public function persist(AbstractEntity $model)
    {
        if (null === $model->getDateModified()) $model->setDateModified(new \DateTime());
        $this->_em->persist($model);
        $this->_em->flush();
        return $this;
    }

    /**
     * Remove
     *
     * Removes the provided entity from persistent storage.
     *
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
     * Set Service Locator
     *
     * Set the provided service locator to a property.
     *
     * @param ServiceLocatorInterface $serviceLocator The service locator to store.
     * @return AbstractService Returns the service to allow for method chaining.
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Sort Entities By Property
     *
     * Sort the provided entities by the provided property in the provided direction.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @param AbstractEntity[] $entities The entities to sort.
     * @param string $property The property to sort by.
     * @param string $direction The direction to sort the entities in.
     * @return AbstractEntity[] The sorted entities.
     */
    public function sortEntitiesByProperty($entities, $property = 'id', $direction = 'ascending')
    {

        // Cleanse parameters.
        $property = trim((string)$property);
        if ('' === $property) $property = 'id';
        $sortDirection = 'ascending';
        if ('descending' === trim((string)$direction)) $sortDirection = 'descending';


        // Sort the entities.
        usort(
            $entities,
            function ($a, $b) use ($property, $sortDirection) {
                if ('descending' === $sortDirection) return strcmp($b->$property, $a->$property);
                return strcmp($a->$property, $b->$property);
            }
        );
        return $entities;
    }
}