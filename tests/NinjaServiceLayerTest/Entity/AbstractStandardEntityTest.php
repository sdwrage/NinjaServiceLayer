<?php

namespace NinjaServiceLayerTest\Entity;

use PHPUnit_Framework_TestCase;

class AbstractStandardEntityTest extends PHPUnit_Framework_TestCase
{
  public function testPropertyDefaultValues()
  {
    $entity = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractStandardEntity');
    $this->assertEquals(null, $entity->getId());
  }

  public function testGetAndSetId()
  {
    $entity = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractStandardEntity');
    $this->assertEquals(null, $entity->getId());
    $entity->setId(2345);
    $this->assertEquals(2345, $entity->getId());
  }
}
