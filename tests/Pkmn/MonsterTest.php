<?php

namespace Pkmn;

class MonsterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Monster */
    private $_monster;

    public function setup()
    {
        $this->_monster = new Monster();
    }

    public function testSetSpeciesWithEmptyString()
    {
        $this->setExpectedException('InvalidArgumentException', 'Species must be a non empty string');
        $this->_monster->setSpecies('');
    }

    public function testSetSpeciesWithArray()
    {
        $this->setExpectedException('InvalidArgumentException', 'Species must be a non empty string');
        $this->_monster->setSpecies(array('value'));
    }

    public function testSetSpeciesWithNull()
    {
        $this->setExpectedException('InvalidArgumentException', 'Species must be a non empty string');
        $this->_monster->setSpecies(null);
    }

    public function testSetAndGetSpecies()
    {
        $this->_monster->setSpecies('abra');
        $this->assertEquals('abra', $this->_monster->getSpecies());
    }

    public function testGetSpeciesWithSpeciesNotSpecified()
    {
        $this->setExpectedException('Pkmn\Exception\SpeciesNotSpecified');
        $this->_monster->getSpecies();
    }
}
 