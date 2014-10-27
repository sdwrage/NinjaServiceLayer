<?php

namespace NinjaServiceLayerTest\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit_Framework_TestCase;

class AbstractNeverDeletedEntityTest extends PHPUnit_Framework_TestCase
{
  public function testPropertyDefaultValues()
  {
    $stub = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractNeverDeletedEntity');
    $this->assertEquals(false, $stub->getDeleted());
    $this->assertEquals(null, $stub->getDateAdded());
    $this->assertEquals(null, $stub->getDateModified());
  }

  public function testOnlyNotDeletedReturned()
  {
    $collection = new ArrayCollection();
    $notDeletedEntity = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractNeverDeletedEntity');
    $deletedEntity = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractNeverDeletedEntity');
    $deletedEntity->setDeleted(true);
    $collection->add($notDeletedEntity);
    $collection->add($deletedEntity);
    $this->assertEquals(2, count($collection));

    $collection = $notDeletedEntity->getNotDeleted($collection);
    $this->assertEquals(1, count($collection));
  }

  public function testGetAndSetDeleted()
  {
    $entity = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractNeverDeletedEntity');
    $this->assertEquals(false, $entity->getDeleted());
    $entity->setDeleted(true);
    $this->assertEquals(true, $entity->getDeleted());
    $entity->setDeleted('');
    $this->assertEquals(false, $entity->getDeleted());
    $entity->setDeleted('a');
    $this->assertEquals(true, $entity->getDeleted());
  }

  public function testGetAndSetDateAdded()
  {
    $entity = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractNeverDeletedEntity');
    $this->assertEquals(null, $entity->getDateAdded());
    $now = new DateTime();
    $entity->setDateAdded($now);
    $this->assertEquals($now, $entity->getDateAdded());
  }

  public function testGetAndSetDateModified()
  {
    $entity = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractNeverDeletedEntity');
    $this->assertEquals(null, $entity->getDateModified());
    $now = new DateTime();
    $entity->setDateModified($now);
    $this->assertEquals($now, $entity->getDateModified());
  }
}
