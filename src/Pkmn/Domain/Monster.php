<?php

namespace Pkmn\Domain;

use Pkmn\Domain\Exception\SpeciesNotSpecified;

class Monster
{
    /** @var string */
    private $_species;

    /**
     * @param string $species
     * @throws \InvalidArgumentException
     */
    public function setSpecies($species)
    {
        if(!is_string($species) || empty($species)) {
            throw new \InvalidArgumentException('Species must be a non empty string');
        }
        $this->_species = $species;
    }

    /**
     * @throws Exception\SpeciesNotSpecified
     * @return string
     */
    public function getSpecies()
    {
        if(!isset($this->_species)) {
            throw new SpeciesNotSpecified();
        }
        return $this->_species;
    }
} 