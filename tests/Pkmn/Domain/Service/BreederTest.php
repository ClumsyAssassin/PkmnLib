<?php

namespace Pkmn\Domain\Service;

use Pkmn\Domain\EggGroup;
use Pkmn\Domain\EggGroupCollection;
use Pkmn\Domain\Gender;
use Pkmn\Domain\Monster;
use Pkmn\Domain\Type;
use Pkmn\Domain\TypeCollection;

class BreederTest extends \PHPUnit_Framework_TestCase
{
    /** @var Breeder */
    private $_breeder;

    /** @var TypeCollection */
    private $_types;

    protected function setUp()
    {
        $this->_breeder = new Breeder();
        $this->_types = new TypeCollection(new Type(Type::BUG));
    }

    public function testCanBreedWithOppositeGenderAndSameEggGroupAndSameGeneration()
    {
        $monsterA = new Monster('name', new Gender(Gender::MALE), 1, new EggGroupCollection(array(new EggGroup(EggGroup::BUG), new EggGroup(EggGroup::FLYING))), $this->_types);
        $monsterB = new Monster('name', new Gender(Gender::FEMALE), 1, new EggGroupCollection(new EggGroup(EggGroup::BUG)), $this->_types);
        $this->assertTrue($this->_breeder->canBreed($monsterA, $monsterB));
        $this->assertTrue($this->_breeder->canBreed($monsterB, $monsterA));
    }

    public function testCanBreedDittoWithOtherEggGroups()
    {
        $ditto = new Monster('Ditto', new Gender(Gender::GENDERLESS), 1, new EggGroupCollection(new EggGroup(EggGroup::DITTO)), $this->_types);
        $monsterB = new Monster('name', new Gender(Gender::FEMALE), 1, new EggGroupCollection(new EggGroup(EggGroup::BUG)), $this->_types);
        $monsterC = new Monster('name', new Gender(Gender::MALE), 1, new EggGroupCollection(array(new EggGroup(EggGroup::BUG), new EggGroup(EggGroup::FLYING))), $this->_types);
        $monsterD = new Monster('name', new Gender(Gender::GENDERLESS), 1, new EggGroupCollection(array(new EggGroup(EggGroup::MINERAL))), $this->_types);

        $this->assertTrue($this->_breeder->canBreed($ditto, $monsterB));
        $this->assertTrue($this->_breeder->canBreed($ditto, $monsterC));
        $this->assertTrue($this->_breeder->canBreed($ditto, $monsterD));
        $this->assertTrue($this->_breeder->canBreed($monsterB, $ditto));
        $this->assertTrue($this->_breeder->canBreed($monsterC, $ditto));
        $this->assertTrue($this->_breeder->canBreed($monsterD, $ditto));
    }

    public function testCannotBreedDittoWithUndiscovered()
    {
        $ditto = new Monster('Ditto', new Gender(Gender::GENDERLESS), 1, new EggGroupCollection(new EggGroup(EggGroup::DITTO)), $this->_types);
        $undiscovered = new Monster('name', new Gender(Gender::MALE), 1, new EggGroupCollection(array(new EggGroup(EggGroup::UNDISCOVERED))), $this->_types);
        $this->assertFalse($this->_breeder->canBreed($ditto, $undiscovered));
        $this->assertFalse($this->_breeder->canBreed($undiscovered, $ditto));
    }

    public function testCannotBreedDittoWithDitto()
    {
        $ditto = new Monster('Ditto', new Gender(Gender::GENDERLESS), 1, new EggGroupCollection(new EggGroup(EggGroup::DITTO)), $this->_types);
        $dittoClone = clone $ditto;
        $this->assertFalse($this->_breeder->canBreed($ditto, $dittoClone));
        $this->assertFalse($this->_breeder->canBreed($dittoClone, $ditto));
    }

    public function testCannotBreedWithSameGender()
    {
        $monsterA = new Monster('name', new Gender(Gender::MALE), 1, new EggGroupCollection(new EggGroup(EggGroup::BUG)), $this->_types);
        $monsterB = clone $monsterA;
        $this->assertFalse($this->_breeder->canBreed($monsterA, $monsterB));
        $this->assertFalse($this->_breeder->canBreed($monsterB, $monsterA));

        $monsterA = new Monster('name', new Gender(Gender::FEMALE), 1, new EggGroupCollection(new EggGroup(EggGroup::BUG)), $this->_types);
        $monsterB = clone $monsterA;
        $this->assertFalse($this->_breeder->canBreed($monsterA, $monsterB));
        $this->assertFalse($this->_breeder->canBreed($monsterB, $monsterA));
    }

    public function testCannotBreedWithDifferentEggGroup()
    {
        $monsterA = new Monster('name', new Gender(Gender::MALE), 1, new EggGroupCollection(new EggGroup(EggGroup::BUG)), $this->_types);
        $monsterB = new Monster('name', new Gender(Gender::FEMALE), 1, new EggGroupCollection(new EggGroup(EggGroup::AMORPHOUS)), $this->_types);
        $this->assertFalse($this->_breeder->canBreed($monsterA, $monsterB));
        $this->assertFalse($this->_breeder->canBreed($monsterB, $monsterA));

        $monsterA = new Monster('name', new Gender(Gender::MALE), 1, new EggGroupCollection(array(new EggGroup(EggGroup::BUG), new EggGroup(EggGroup::DRAGON))), $this->_types);
        $monsterB = new Monster('name', new Gender(Gender::FEMALE), 1, new EggGroupCollection(array(new EggGroup(EggGroup::AMORPHOUS), new EggGroup(EggGroup::FLYING))), $this->_types);
        $this->assertFalse($this->_breeder->canBreed($monsterA, $monsterB));
        $this->assertFalse($this->_breeder->canBreed($monsterB, $monsterA));
    }

    public function testCannotBreedWhenUndiscoveredEggGroup()
    {
        $monsterA = new Monster('name', new Gender(Gender::MALE), 1, new EggGroupCollection(array(new EggGroup(EggGroup::UNDISCOVERED))), $this->_types);
        $monsterB = new Monster('name', new Gender(Gender::FEMALE), 1, new EggGroupCollection(new EggGroup(EggGroup::UNDISCOVERED)), $this->_types);
        $this->assertFalse($this->_breeder->canBreed($monsterA, $monsterB));
        $this->assertFalse($this->_breeder->canBreed($monsterB, $monsterA));
    }

    public function testCannotBreedWithGen1AndGen3Monsters()
    {
        $monsterA = new Monster('name', new Gender(Gender::MALE), 1, new EggGroupCollection(array(new EggGroup(EggGroup::BUG))), $this->_types);
        $monsterB = new Monster('name', new Gender(Gender::FEMALE), 3, new EggGroupCollection(array(new EggGroup(EggGroup::BUG))), $this->_types);
        $this->assertFalse($this->_breeder->canBreed($monsterA, $monsterB));
        $this->assertFalse($this->_breeder->canBreed($monsterB, $monsterA));
    }
}