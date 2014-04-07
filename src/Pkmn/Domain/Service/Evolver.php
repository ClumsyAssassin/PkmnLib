<?php

namespace Pkmn\Domain\Service;

use Pkmn\Domain\EvolutionRequirement;
use Pkmn\Domain\EvolutionRequirementCollection;
use Pkmn\Domain\Monster;

class Evolver
{
    /** @var EvolutionRequirementsCollection */
    private $_requirements;

    public function __construct()
    {
        $this->setRequirements(new EvolutionRequirementCollection());
    }

    /**
     * @param EvolutionRequirementCollection $requirements
     */
    public function setRequirements(EvolutionRequirementCollection $requirements)
    {
        $this->_requirements = $requirements;
    }

    /**
     * @param EvolutionRequirement $requirement
     */
    public function addRequirement(EvolutionRequirement $requirement)
    {
        $this->_requirements[] = $requirement;
    }

    /**
     * @param Monster $monster
     * @return bool
     */
    public function canEvolve(Monster $monster)
    {
        return $this->_requirements->allRequirementsMet($monster);
    }
} 