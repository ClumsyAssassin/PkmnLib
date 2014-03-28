<?php

namespace Pkmn\Domain;

class MonsterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Monster */
    private $_monster;

    public function setup()
    {
        $this->_monster = $this->getMockForAbstractClass('Pkmn\Domain\Monster');
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
        $this->setExpectedException('Pkmn\Domain\Exception\SpeciesNotSpecified');
        $this->_monster->getSpecies();
    }

    public function testSetGenderWithMale()
    {
        $this->_monster->setGender(Monster::MALE);
        $this->assertEquals(Monster::MALE, $this->_monster->getGender());
    }

    public function testSetGenderWithFemale()
    {
        $this->_monster->setGender(Monster::FEMALE);
        $this->assertEquals(Monster::FEMALE, $this->_monster->getGender());
    }

    public function testSetGenderWithGenderless()
    {
        $this->_monster->setGender(Monster::GENDERLESS);
        $this->assertEquals(Monster::GENDERLESS, $this->_monster->getGender());
    }

    public function testSetGenderWithNotKnownGender()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->_monster->setGender('this is not a valid gender');
    }

    public function testGetGenderWhenGenderNotSpecified()
    {
        $this->setExpectedException('Pkmn\Domain\Exception\GenderNotSpecified');
        $this->_monster->getGender();
    }

    public function testIsLegendary()
    {
        $this->assertFalse($this->_monster->isLegendary());
        $this->_monster->setLegendary(true);
        $this->assertTrue($this->_monster->isLegendary());
    }

    public function testSetLegendaryWithNull()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->_monster->setLegendary(null);
    }

    public function testGetGenerationWhenNotSpecified()
    {
        $this->setExpectedException('Pkmn\Domain\Exception\GenerationNotSpecified');
        $this->_monster->getGeneration();
    }

    public function testCanTransferToWithAnotherGen()
    {
        $this->setExpectedException('Pkmn\Domain\Exception\GenerationNotSpecified');
        $this->_monster->canTransferTo(6);
    }
}
 