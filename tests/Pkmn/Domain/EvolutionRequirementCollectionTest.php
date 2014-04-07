<?php

namespace Pkmn\Domain;

class EvolutionRequirementCollectionTest extends \PHPUnit_Framework_TestCase
{
    /** @var EvolutionRequirementCollection */
    private $_collection;

    /** @var Monster */
    private $_monster;

    public function setUp()
    {
        $this->_collection = new EvolutionRequirementCollection();
        $this->_monster = new Monster('name', new Gender(Gender::MALE), 1, new EggGroupCollection(new EggGroup(EggGroup::BUG)), new TypeCollection(new Type(Type::BUG)));
    }

    public function testAllRequirementsAreMetWhenThereAreNoRequirements()
    {
        $this->assertTrue($this->_collection->allRequirementsMet($this->_monster));
    }

    public function testAllRequirementsAreMetWhenSomeAreNot()
    {
        $unmetRequirement = $this->getMockForAbstractClass('\Pkmn\Domain\EvolutionRequirement');
        $unmetRequirement->expects($this->once())
            ->method('requirementMet')
            ->will($this->returnValue(false));
        $this->_collection[] = $unmetRequirement;
        $this->assertFalse($this->_collection->allRequirementsMet($this->_monster));
    }

    public function testAllRequirementsWhenTheyAreMet()
    {
        $requirement = $this->getMockForAbstractClass('\Pkmn\Domain\EvolutionRequirement');
        $requirement->expects($this->any())
            ->method('requirementMet')
            ->will($this->returnValue(true));
        $this->_collection[] = $requirement;
        $this->assertTrue($this->_collection->allRequirementsMet($this->_monster));
    }
}