<?php

namespace NinjaServiceLayerTest\Entity;

use PHPUnit_Framework_TestCase;

class AbstractEntityTest extends PHPUnit_Framework_TestCase
{
	public function testConstructorCallsSetOptions()
	{
		$stub = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractEntity');

		$this->setExpectedException('Exception', 'Property does not exist.');

		$stub->__construct(array('test' => 'test'));
	}

	public function testConstructorDoesNotCallSetOptions()
	{
		$stub = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractEntity');

		$stub->expects($this->exactly(0))
			->method('setOptions');

		$stub->__construct();
		$stub->__construct(null);
		$stub->__construct(array());
	}

	public function testThatGetMagicMethodIsCalled()
	{
		$stub = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractEntity');

		$this->setExpectedException('Exception', 'Property does not exist.');

		$stub->test;
	}

	public function testThatSetMagicMethodIsCalled()
	{
		$stub = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractEntity');

		$this->setExpectedException('Exception', 'Property does not exist.');

		$stub->test = 'test';
	}

	public function testSetOptionsTriesToSetProperties()
	{
		$stub = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractEntity');

		$this->setExpectedException('Exception', 'Property does not exist.');

		$stub->setOptions(array('test' => 'test'));
	}

	public function testSetopOptionsDoesNotTryToSetProperties()
	{
		$stub = $this->getMockForAbstractClass('NinjaServiceLayer\Entity\AbstractEntity');
		
		$stub->expects($this->exactly(0))
			->method('__set');

		$stub->setOptions();
		$stub->setOptions(null);
		$stub->setOptions(array());
	}
}