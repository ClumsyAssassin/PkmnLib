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

    public function testCanTransferWithNull()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->_monster->canTransferTo(null);
    }

    public function testCanTransferToGenerations()
    {
        $this->assertTrue($this->_monster->canTransferTo(1));
        $this->assertTrue($this->_monster->canTransferTo(2));
        if (Monster::LATEST_GENERATION > 2) {
            for ($i = 3; $i <= Monster::LATEST_GENERATION; $i++) {
                $this->assertFalse($this->_monster->canTransferTo($i));
            }
        }
    }
}
 