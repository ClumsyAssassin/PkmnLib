<?php

namespace Pkmn\Domain;

class Gen1MonsterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Gen1Monster */
    private $_monster;

    public function setup()
    {
        $this->_monster = new Gen1Monster();
    }

    public function testCanBreedWithAnotherMonster()
    {
        $this->assertFalse($this->_monster->canBreedWith(new Gen1Monster()));
    }

    public function testCanTransferToGen1()
    {
        $this->assertTrue($this->_monster->canTransferTo(1));
    }

    public function testCanTransferToGen2()
    {
        $this->assertTrue($this->_monster->canTransferTo(2));
    }

    public function testCanTransferToGen3()
    {
        $this->assertFalse($this->_monster->canTransferTo(3));
    }

    public function testCanTransferWithNull()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->_monster->canTransferTo(null);
    }
}
 