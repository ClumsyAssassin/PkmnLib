<?php

namespace Pkmn\Domain;

use Pkmn\Domain\Exception\GenderNotSpecified;
use Pkmn\Domain\Exception\SpeciesNotSpecified;

class Monster
{
    const MALE = 'male';
    const FEMALE = 'female';
    const GENDERLESS = 'genderless';

    /** @var array  */
    private static $_validGenders = array(self::MALE, self::FEMALE, self::GENDERLESS);

    /** @var string */
    private $_species;

    /** @var string */
    private $_gender;

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

    /**
     * @param string $gender
     * @throws \InvalidArgumentException
     */
    public function setGender($gender)
    {
        if(!in_array($gender, self::$_validGenders)) {
            throw new \InvalidArgumentException('Gender specified is not a valid gender');
        }
        $this->_gender = $gender;
    }

    /**
     * @throws Exception\GenderNotSpecified
     * @return string
     */
    public function getGender()
    {
        if(!isset($this->_gender)) {
            throw new GenderNotSpecified();
        }
        return $this->_gender;
    }
} 