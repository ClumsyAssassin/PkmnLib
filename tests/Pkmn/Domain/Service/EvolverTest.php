<?php

namespace Pkmn\Domain\Service;

use Pkmn\Domain\EggGroup;
use Pkmn\Domain\EggGroupCollection;
use Pkmn\Domain\Gender;
use Pkmn\Domain\Monster;
use Pkmn\Domain\Type;
use Pkmn\Domain\TypeCollection;

class EvolverTest extends \PHPUnit_Framework_TestCase
{
    /** @var Evolver */
    private $_evolver;

    /** @var \Pkmn\Domain\Monster */
    private $_monster;

    protected function setUp()
    {
        $this->_evolver = new Evolver();
        $this->_monster = new Monster('name', new Gender(Gender::MALE), 1, new EggGroupCollection(new EggGroup(EggGroup::AMORPHOUS)), new TypeCollection(new Type(Type::BUG)));
    }

    public function testCanEvolveIfNoRequirementsSet()
    {
        $this->assertTrue($this->_evolver->canEvolve($this->_monster));
    }

    public function testCannotEvolveIfARequirementIsNotMet()
    {
        $requirement = $this->getMockForAbstractClass('\Pkmn\Domain\EvolutionRequirement');
        $requirement->expects($this->any())
            ->method('requirementMet')
            ->will($this->returnValue(false));
        $this->_evolver->addRequirement($requirement);
        $this->assertFalse($this->_evolver->canEvolve($this->_monster));
    }

    public function testCanEvolveIfAllRequirementsAreMet()
    {
        $requirement = $this->getMockForAbstractClass('\Pkmn\Domain\EvolutionRequirement');
        $requirement->expects($this->any())
            ->method('requirementMet')
            ->will($this->returnValue(true));
        $this->_evolver->addRequirement($requirement);
        $this->assertTrue($this->_evolver->canEvolve($this->_monster));
    }
}