<?php

namespace Pkmn\Domain;

use InvalidArgumentException;

class Monster
{
    const MIN_NUM_EGG_GROUPS = 1;
    const MAX_NUM_EGG_GROUPS = 2;

    const MIN_NUM_TYPES = 1;
    const MAX_NUM_TYPES = 2;

    /** @var string */
    private $_name;

    /** @var Gender */
    private $_gender;

    /** @var int */
    private $_generation;

    /** @var array */
    private $_eggGroups;

    /** @var array */
    private $_types;

    /**
     * @param string $name
     * @param Gender $gender
     * @param int $generation
     * @param array $eggGroups
     * @param array $types
     */
    public function __construct($name, Gender $gender, $generation, array $eggGroups, array $types)
    {
        $this->_assertParametersAreValid($name, $gender, $generation, $eggGroups, $types);

        $this->_name = $name;
        $this->_gender = $gender;
        $this->_generation = $generation;
        $this->_eggGroups = $eggGroups;
        $this->_types = $types;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @return int
     */
    public function getGeneration()
    {
        return $this->_generation;
    }

    /**
     * @param array $eggGroups
     * @throws InvalidArgumentException
     */
    private function _assertEggGroupsWithinBounds(array $eggGroups)
    {
        $numEggGroups = count($eggGroups);
        if ($numEggGroups > self::MAX_NUM_EGG_GROUPS)
            throw new InvalidArgumentException("Number of egg groups is more than max " . self::MAX_NUM_EGG_GROUPS);
        else if ($numEggGroups < self::MIN_NUM_EGG_GROUPS)
            throw new InvalidArgumentException("Number of egg groups is less than min " . self::MIN_NUM_EGG_GROUPS);
    }

    /**
     * @param array $eggGroups
     * @throws InvalidArgumentException
     */
    private function _assertValidEggGroups(array $eggGroups)
    {
        foreach ($eggGroups as $eggGroup) {
            if ($eggGroup instanceof EggGroup)
                throw new InvalidArgumentException("Egg group '{$eggGroup}' is not an egg group");
        }
    }

    /**
     * @param string $name
     * @param Gender $gender
     * @param array $eggGroups
     * @throws \InvalidArgumentException
     */
    private function _assertValidDitto($name, Gender $gender, array $eggGroups)
    {
        if (count($eggGroups) > 1)
            throw new InvalidArgumentException("Ditto egg group cannot be combined with another egg group");
        else if ($name != 'Ditto')
            throw new InvalidArgumentException("Ditto egg group can only be assigned to monster named Ditto");
        else if ($gender->getGender() != Gender::GENDERLESS)
            throw new InvalidArgumentException("Ditto egg group can only be assigned to genderless monster");
    }

    /**
     * @param array $eggGroups
     * @throws InvalidArgumentException
     */
    private function _assertValidUndiscovered(array $eggGroups)
    {
        if (count($eggGroups) > 1)
            throw new InvalidArgumentException("Undiscovered egg group cannot be combined with another egg group");
    }

    /**
     * @param string $name
     * @param Gender $gender
     * @param int $generation
     * @param array $eggGroups
     * @param array $types
     * @throws InvalidArgumentException
     */
    private function _assertParametersAreValid($name, Gender $gender, $generation, array $eggGroups, array $types)
    {
        if (!is_string($name))
            throw new InvalidArgumentException("Name '{$name}' must be a string");

        if (!is_int($generation))
            throw new InvalidArgumentException("Generation '{$generation}' must be an integer");

        $this->_assertTypesWithinBounds($types);
        $this->_assertValidTypes($types);

        $this->_assertEggGroupsWithinBounds($eggGroups);
        if (in_array(EggGroup::EGG_GROUP_DITTO, $eggGroups))
            $this->_assertValidDitto($name, $gender, $eggGroups);
        elseif (in_array(EggGroup::EGG_GROUP_UNDISCOVERED, $eggGroups))
            $this->_assertValidUndiscovered($eggGroups);
        else
            $this->_assertValidEggGroups($eggGroups);
    }

    /**
     * @param array $types
     * @throws \InvalidArgumentException
     */
    private function _assertTypesWithinBounds(array $types)
    {
        $numTypes = count($types);
        if ($numTypes > self::MAX_NUM_EGG_GROUPS)
            throw new InvalidArgumentException("Number of types is more than max " . self::MAX_NUM_TYPES);
        else if ($numTypes < self::MIN_NUM_TYPES)
            throw new InvalidArgumentException("Number of types is less than min " . self::MIN_NUM_TYPES);
    }

    /**
     * @param array $types
     * @throws \InvalidArgumentException
     */
    private function _assertValidTypes(array $types)
    {
        foreach ($types as $type)
            if ($type instanceof Type)
                throw new InvalidArgumentException("Type '{$type}' is not an instance of Type");
    }
}