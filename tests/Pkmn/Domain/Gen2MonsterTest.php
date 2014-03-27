<?php

namespace Pkmn\Domain;

class Gen2MonsterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Gen2Monster */
    private $_monster;

    public function setup()
    {
        $this->_monster = new Gen2Monster();
    }

    public function testCanTransferWithNull()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->_monster->canTransferTo(null);
    }

    public function testCanTransferToGen1()
    {
        $this->assertFalse($this->_monster->canTransferTo(1));
    }

    public function testCanTransferToGen2()
    {
        $this->assertTrue($this->_monster->canTransferTo(2));
    }

    public function testCanTransferToGen3()
    {
        $this->assertFalse($this->_monster->canTransferTo(3));
    }
}