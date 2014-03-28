<?php

namespace Pkmn\Domain;

class Gen6MonsterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Gen6Monster */
    private $_monster;

    public function setup()
    {
        $this->_monster = new Gen6Monster();
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
 