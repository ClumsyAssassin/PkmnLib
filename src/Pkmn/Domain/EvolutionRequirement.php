<?php

namespace Pkmn\Domain;

abstract class EvolutionRequirement
{
    /**
     * Verify that the requirement has been met with a given monster
     * @param Monster $monster
     * @return bool
     */
    public abstract function requirementMet(Monster $monster);
} 