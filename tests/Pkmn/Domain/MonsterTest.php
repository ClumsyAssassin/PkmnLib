<?php

namespace Pkmn\Domain;

class MonsterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Gender */
    private $_gender;

    /** @var EggGroupCollection */
    private $_eggGroupCollection;

    /** @var TypeCollection */
    private $_typeCollection;

    public function setUp()
    {
        $this->_gender = new Gender(Gender::MALE);
        $this->_eggGroupCollection = new EggGroupCollection(new EggGroup(EggGroup::MONSTER));
        $this->_typeCollection = new TypeCollection(new Type(Type::NORMAL));
    }

    public function testMonsterNameIsName()
    {
        $monster = new Monster('name', $this->_gender, 1, $this->_eggGroupCollection, $this->_typeCollection);
        $this->assertEquals('name', $monster->getName());
    }

    public function testCreateMonsterWithInvalidName()
    {
        $this->setExpectedException('InvalidArgumentException', "Name '343' must be a string");
        new Monster(343, $this->_gender, 1, $this->_eggGroupCollection, $this->_typeCollection);
    }

    public function testCreateMonsterWithInvalidGeneration()
    {
        $this->setExpectedException('InvalidArgumentException', "Generation 'notInt' must be an integer");
        new Monster('name', $this->_gender, 'notInt', $this->_eggGroupCollection, $this->_typeCollection);
    }

    public function testCreateMonsterWithMoreThanTwoEggGroupsShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Number of egg groups is more than max " . Monster::MAX_NUM_EGG_GROUPS);
        new Monster('name', $this->_gender, 1,
            new EggGroupCollection(array(new EggGroup(EggGroup::MONSTER), new EggGroup(EggGroup::WATER1), new EggGroup(EggGroup::WATER2))),
            $this->_typeCollection);
    }

    public function testCreateMonsterWithNoEggGroupsShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Number of egg groups is less than min " . Monster::MIN_NUM_EGG_GROUPS);
        new Monster('name', $this->_gender, 1, new EggGroupCollection(), $this->_typeCollection);
    }

    public function testCreateMonsterThatHasDittoEggGroupButIsNotNamedDitto()
    {
        $this->setExpectedException('InvalidArgumentException', "Ditto egg group can only be assigned to monster named Ditto");
        new Monster('name', new Gender(Gender::GENDERLESS), 1, new EggGroupCollection(new EggGroup(EggGroup::DITTO)), $this->_typeCollection);
    }

    public function testCreateMonsterWithMoreThanDittoEggGroupShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Ditto egg group cannot be combined with another egg group");
        new monster('Ditto', new Gender(Gender::GENDERLESS), 1, new EggGroupCollection(array(new EggGroup(EggGroup::DITTO), new EggGroup(EggGroup::BUG))), $this->_typeCollection);
    }

    public function testCreateMonsterThatIsDittoShouldBeGenderless()
    {
        $this->setExpectedException('InvalidArgumentException', "Ditto egg group can only be assigned to genderless monster");
        new monster('Ditto', $this->_gender, 1, new EggGroupCollection(new EggGroup(EggGroup::DITTO)), $this->_typeCollection);
    }

    public function testCreateMonsterWithMoreThanUndiscoveredEggGroupShouldFail()
    {
        $this->setExpectedException('InvalidArgumentException', "Undiscovered egg group cannot be combined with another egg group");
        new monster('name', new Gender(Gender::GENDERLESS), 1, new EggGroupCollection(array(new EggGroup(EggGroup::UNDISCOVERED), new EggGroup(EggGroup::BUG))), $this->_typeCollection);
    }

    public function testCreateMonsterWithNoType()
    {
        $this->setExpectedException('InvalidArgumentException', "Number of types is less than min " . Monster::MIN_NUM_TYPES);
        new Monster('name', $this->_gender, 1, $this->_eggGroupCollection, new TypeCollection());
    }

    public function testCreateMonsterWithTooManyTypes()
    {
        $this->setExpectedException('InvalidArgumentException', "Number of types is more than max " . Monster::MAX_NUM_TYPES);
        new Monster('name', $this->_gender, 1, $this->_eggGroupCollection,
            new TypeCollection(array(new Type(Type::NORMAL), new Type(Type::FIRE), new Type(Type::WATER))));
    }
}