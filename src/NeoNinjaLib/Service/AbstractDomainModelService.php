<?php

namespace NeoNinjaLib\Service;

use NeoNinjaLib\Domain\PersistableModel;
use NeoNinjaLib\Service\AbstractDomainService;

class AbstractDomainModelService extends AbstractDomainService
{
    protected $entity = '';

    public function getAll()
    {
        return $this->getEntityManager()
                ->createQuery('SELECT e FROM ' . $this->entity . ' e')
                ->getResult();
    }

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

    public function persist(PersistableModel $model)
    {
        $this->getEntityManager()->persist($model);
        $this->getEntityManager()->flush();
        return $this;
    }

    public function remove(PersistableModel $model)
    {
        $this->getEntityManager()->remove($model);
        $this->getEntityManager()->flush();
        return $this;
    }

    public function getNewEntity()
    {
        return new $this->entity;
    }
}
