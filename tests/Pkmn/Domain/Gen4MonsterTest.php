<?php

namespace Pkmn\Domain;

class Gen4MonsterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Gen4Monster */
    private $_monster;

    public function setup()
    {
        $this->_monster = new Gen4Monster();
    }

    public function testCanTransferWithNull()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->_monster->canTransferTo(null);
    }

    public function testCanTransferToGenerations()
    {
        for($i = 1; $i < $this->_monster->getGeneration(); $i++) {
            $this->assertFalse($this->_monster->canTransferTo($i));
        }
        for ($k = $this->_monster->getGeneration(); $k <= Monster::LATEST_GENERATION; $k++) {
            $this->assertTrue($this->_monster->canTransferTo($k));
        }
    }
}
 