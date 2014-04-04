<?php

namespace Pkmn\Domain;

class MonsterTest extends \PHPUnit_Framework_TestCase
{
    public function testMonsterNameIsName()
    {
        $monster = new Monster('name', 'male', 1, array('monster'));
        $this->assertEquals('name', $monster->getName());
    }

    public function testCreateMonsterWithInvalidName()
    {
        $this->setExpectedException('InvalidArgumentException', "Name '343' must be a string");
        new Monster(343, 'male', 1, array('monster'));
    }

    public function testCreateMonsterWithInvalidGeneration()
    {
        $this->setExpectedException('InvalidArgumentException', "Generation 'notInt' must be an integer");
        new Monster('name', 'male', 'notInt', array('monster'));
    }

    public function testCreateMonstersWithValidGenders()
    {
        $this->_assertGenderIsValid(Monster::MALE);
        $this->_assertGenderIsValid(Monster::FEMALE);
        $this->_assertGenderIsValid(Monster::GENDERLESS);
    }

    public function testCreateMonsterWithInvalidGender()
    {
        $this->setExpectedException('InvalidArgumentException', "Gender 'invalidGender' is invalid");
        new Monster('name', 'invalidGender', 1, array('monster'));
    }

    public function testCreateMonsterWithInvalidEggGroup()
    {
        $this->setExpectedException('InvalidArgumentException');
        new Monster('name', 'male', 1, array('badEggGroup', "Egg group 'badEggGroup' is invalid"));
    }

    public function testCreateMonsterWithMoreThanTwoEggGroupsShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Number of egg groups is more than max " . Monster::MAX_NUM_EGG_GROUPS);
        new Monster('name', 'male', 1, array('monster', 'water1', 'water2'));
    }

    public function testCreateMonsterWithNoEggGroupsShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Number of egg groups is less than min " . Monster::MIN_NUM_EGG_GROUPS);
        new Monster('name', 'male', 1, array());
    }

    public function testCreateMonsterThatHasDittoEggGroupButIsNotNamedDitto()
    {
        $this->setExpectedException('InvalidArgumentException', "Ditto egg group can only be assigned to monster named Ditto");
        new Monster('name', 'genderless', 1, array('ditto'));
    }

    public function testCreateMonsterWithMoreThanDittoEggGroupShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Ditto egg group cannot be combined with another egg group");
        new monster('Ditto', 'genderless', 1, array('ditto', 'monster'));
    }

    public function testCreateMonsterThatIsDittoShouldBeGenderless()
    {
        $this->setExpectedException('InvalidArgumentException', "Ditto egg group can only be assigned to genderless monster");
        new monster('Ditto', 'male', 1, array('ditto'));
    }

    public function testCreateMonsterWithMoreThanUndiscoveredEggGroupShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Undiscovered egg group cannot be combined with another egg group");
        new monster('name', 'genderless', 1, array('undiscovered', 'monster'));
    }

    /**
     * @param string $gender
     */
    private function _assertGenderIsValid($gender)
    {
        $monster = new Monster('name', $gender, 1, array('monster'));
        $this->assertEquals($gender, $monster->getGender());
    }
}