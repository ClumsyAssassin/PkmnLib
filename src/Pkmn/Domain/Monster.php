<?php

namespace Pkmn\Domain;

use Pkmn\Domain\Exception\GenderNotSpecified;
use Pkmn\Domain\Exception\GenerationNotSpecified;
use Pkmn\Domain\Exception\SpeciesNotSpecified;

abstract class Monster
{
    const MALE = 'male';
    const FEMALE = 'female';
    const GENDERLESS = 'genderless';

    /** @var array */
    private static $_validGenders = array(self::MALE, self::FEMALE, self::GENDERLESS);

    /** @var string */
    private $_species;

    /** @var string */
    private $_gender;

    /** @var boolean */
    private $_legendary = false;

    /** @var int */
    protected $_generation;

    /**
     * @param Monster $partner
     * @return boolean
     */
    public abstract function canBreedWith(Monster $partner);

    /**
     * @param int $generation
     * @return boolean
     */
    public abstract function canTransferTo($generation);

    /**
     * @throws Exception\GenerationNotSpecified
     * @return int
     */
    public function getGeneration()
    {
        if (!isset($this->_generation)) {
            throw new GenerationNotSpecified();
        }
        return $this->_generation;
    }

    /**
     * @param string $species
     * @throws \InvalidArgumentException
     */
    public function setSpecies($species)
    {
        if (!is_string($species) || empty($species)) {
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
        if (!isset($this->_species)) {
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
        if (!in_array($gender, self::$_validGenders)) {
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
        if (!isset($this->_gender)) {
            throw new GenderNotSpecified();
        }
        return $this->_gender;
    }

    /**
     * @return boolean
     */
    public function isLegendary()
    {
        return $this->_legendary;
    }

    /**
     * @param boolean $legendary
     * @throws \InvalidArgumentException
     */
    public function setLegendary($legendary)
    {
        if (!is_bool($legendary)) {
            throw new \InvalidArgumentException('Legendary status must be a boolean');
        }
        $this->_legendary = $legendary;
    }
} 