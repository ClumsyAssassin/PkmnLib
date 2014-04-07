<?php

namespace Pkmn\Domain;

class EggGroupTest extends \PHPUnit_Framework_TestCase
{
    /** @var EggGroup */
    private $_eggGroup;

    protected function setUp()
    {
        $this->_eggGroup = new EggGroup(EggGroup::MONSTER);
    }

    public function testCreateInvalidEggGroup()
    {
        $this->setExpectedException('\Pkmn\Exception\InvalidEggGroup');
        new EggGroup('badEggGroup');
    }

    public function testToStringReturnsMonsterType()
    {
        $this->assertEquals('monster', $this->_eggGroup);
        $this->assertEquals('monster', $this->_eggGroup->getEggGroup());
    }
}
 