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

    public function testCanTransferToGenerations()
    {
        for ($i = 1; $i < $this->_monster->getGeneration(); $i++) {
            $this->assertFalse($this->_monster->canTransferTo($i));
        }
        $this->assertTrue($this->_monster->canTransferTo($this->_monster->getGeneration()));
        if (Monster::LATEST_GENERATION > $this->_monster->getGeneration()) {
            for ($i = $this->_monster->getGeneration() + 1; $i <= Monster::LATEST_GENERATION; $i++) {
                $this->assertFalse($this->_monster->canTransferTo($i));
            }
        }
    }
}