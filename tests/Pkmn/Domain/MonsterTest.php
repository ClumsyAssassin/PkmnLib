<?php

namespace Pkmn\Domain;

class MonsterTest extends \PHPUnit_Framework_TestCase
{
    public function testMonsterNameIsName()
    {
        $monster = new Monster('name', new Gender(Gender::MALE), 1, array('monster'), array('normal'));
        $this->assertEquals('name', $monster->getName());
    }

    public function testCreateMonsterWithInvalidName()
    {
        $this->setExpectedException('InvalidArgumentException', "Name '343' must be a string");
        new Monster(343, new Gender(Gender::MALE), 1, array('monster'), array('normal'));
    }

    public function testCreateMonsterWithInvalidGeneration()
    {
        $this->setExpectedException('InvalidArgumentException', "Generation 'notInt' must be an integer");
        new Monster('name', new Gender(Gender::MALE), 'notInt', array('monster'), array('normal'));
    }

    public function testCreateMonsterWithInvalidEggGroup()
    {
        $this->setExpectedException('InvalidArgumentException');
        new Monster('name', new Gender(Gender::MALE), 1, array('badEggGroup', "Egg group 'badEggGroup' is invalid"), array('normal'));
    }

    public function testCreateMonsterWithMoreThanTwoEggGroupsShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Number of egg groups is more than max " . Monster::MAX_NUM_EGG_GROUPS);
        new Monster('name', new Gender(Gender::MALE), 1, array('monster', 'water1', 'water2'), array('normal'));
    }

    public function testCreateMonsterWithNoEggGroupsShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Number of egg groups is less than min " . Monster::MIN_NUM_EGG_GROUPS);
        new Monster('name', new Gender(Gender::MALE), 1, array(), array('normal'));
    }

    public function testCreateMonsterThatHasDittoEggGroupButIsNotNamedDitto()
    {
        $this->setExpectedException('InvalidArgumentException', "Ditto egg group can only be assigned to monster named Ditto");
        new Monster('name', new Gender(Gender::GENDERLESS), 1, array('ditto'), array('normal'));
    }

    public function testCreateMonsterWithMoreThanDittoEggGroupShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Ditto egg group cannot be combined with another egg group");
        new monster('Ditto', new Gender(Gender::GENDERLESS), 1, array('ditto', 'monster'), array('normal'));
    }

    public function testCreateMonsterThatIsDittoShouldBeGenderless()
    {
        $this->setExpectedException('InvalidArgumentException', "Ditto egg group can only be assigned to genderless monster");
        new monster('Ditto', new Gender(Gender::MALE), 1, array('ditto'), array('normal'));
    }

    public function testCreateMonsterWithMoreThanUndiscoveredEggGroupShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Undiscovered egg group cannot be combined with another egg group");
        new monster('name', new Gender(Gender::GENDERLESS), 1, array('undiscovered', 'monster'), array('normal'));
    }

    public function testCreateMonsterWithNoType()
    {
        $this->setExpectedException('InvalidArgumentException', "Number of types is less than min " . Monster::MIN_NUM_TYPES);
        new Monster('name', new Gender(Gender::MALE), 1, array('monster'), array());
    }

    public function testCreateMonsterWithTooManyTypes()
    {
        $this->setExpectedException('InvalidArgumentException', "Number of types is more than max " . Monster::MAX_NUM_TYPES);
        new Monster('name', new Gender(Gender::MALE), 1, array('monster'), array('normal', 'fire', 'water'));
    }
}