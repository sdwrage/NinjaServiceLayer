<?php

namespace NeoNinjaLib\ServiceManager;

use Doctrine\ORM\EntityManager;

interface EntityManagerAwareInterface
{
    public function setEntityManager(EntityManager $entityManager);
    public function getEntityManager();
}
