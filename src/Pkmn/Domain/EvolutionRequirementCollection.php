<?php

namespace Pkmn\Domain;

use Base\Domain\Collection;

class EvolutionRequirementCollection extends Collection
{
    protected $_validInstance = '\Pkmn\Domain\EvolutionRequirement';

    /**
     * @param Monster $monster
     * @return bool
     */
    public function allRequirementsMet(Monster $monster)
    {
        /** @var EvolutionRequirement $requirement */
        foreach ($this as $requirement)
            if (!$requirement->requirementMet($monster))
                return false;
        return true;
    }
} 