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

    /** @var EggGroupCollection */
    private $_eggGroups;

    /** @var TypeCollection */
    private $_types;

    /**
     * @param string $name
     * @param Gender $gender
     * @param int $generation
     * @param EggGroupCollection $eggGroups
     * @param TypeCollection $types
     */
    public function __construct($name, Gender $gender, $generation, EggGroupCollection $eggGroups, TypeCollection $types)
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
     * @return EggGroupCollection
     */
    public function getEggGroups()
    {
        return $this->_eggGroups;
    }

    /**
     * @return bool
     */
    public function canEvolve()
    {
        return true;
    }

    /**
     * @param EggGroupCollection $eggGroups
     * @throws \InvalidArgumentException
     */
    private function _assertEggGroupsWithinBounds(EggGroupCollection $eggGroups)
    {
        $numEggGroups = count($eggGroups);
        if ($numEggGroups > self::MAX_NUM_EGG_GROUPS)
            throw new InvalidArgumentException("Number of egg groups is more than max " . self::MAX_NUM_EGG_GROUPS);
        else if ($numEggGroups < self::MIN_NUM_EGG_GROUPS)
            throw new InvalidArgumentException("Number of egg groups is less than min " . self::MIN_NUM_EGG_GROUPS);
    }

    /**
     * @param TypeCollection $types
     * @throws \InvalidArgumentException
     */
    private function _assertTypesWithinBounds(TypeCollection $types)
    {
        $numTypes = count($types);
        if ($numTypes > self::MAX_NUM_EGG_GROUPS)
            throw new InvalidArgumentException("Number of types is more than max " . self::MAX_NUM_TYPES);
        else if ($numTypes < self::MIN_NUM_TYPES)
            throw new InvalidArgumentException("Number of types is less than min " . self::MIN_NUM_TYPES);
    }

    /**
     * @param string $name
     * @param Gender $gender
     * @param EggGroupCollection $eggGroups
     * @throws \InvalidArgumentException
     */
    private function _assertValidDitto($name, Gender $gender, EggGroupCollection $eggGroups)
    {
        if (count($eggGroups) > 1)
            throw new InvalidArgumentException("Ditto egg group cannot be combined with another egg group");
        else if ($name != 'Ditto')
            throw new InvalidArgumentException("Ditto egg group can only be assigned to monster named Ditto");
        else if ($gender->getGender() != Gender::GENDERLESS)
            throw new InvalidArgumentException("Ditto egg group can only be assigned to genderless monster");
    }

    /**
     * @param EggGroupCollection $eggGroups
     * @throws InvalidArgumentException
     */
    private function _assertValidUndiscovered(EggGroupCollection $eggGroups)
    {
        if (count($eggGroups) > 1)
            throw new InvalidArgumentException("Undiscovered egg group cannot be combined with another egg group");
    }

    /**
     * @param string $name
     * @param Gender $gender
     * @param int $generation
     * @param EggGroupCollection $eggGroups
     * @param TypeCollection $types
     * @throws \InvalidArgumentException
     */
    private function _assertParametersAreValid($name, Gender $gender, $generation, EggGroupCollection $eggGroups, TypeCollection $types)
    {
        if (!is_string($name))
            throw new InvalidArgumentException("Name '{$name}' must be a string");

        if (!is_int($generation))
            throw new InvalidArgumentException("Generation '{$generation}' must be an integer");

        $this->_assertTypesWithinBounds($types);
        $this->_assertTypesAreUnique($types);

        $this->_assertEggGroupsWithinBounds($eggGroups);
        $this->_assertEggGroupsAreUnique($eggGroups);

        if ($eggGroups->inCollection(EggGroup::DITTO))
            $this->_assertValidDitto($name, $gender, $eggGroups);
        elseif ($eggGroups->inCollection(EggGroup::UNDISCOVERED))
            $this->_assertValidUndiscovered($eggGroups);
    }

    /**
     * @param TypeCollection $types
     * @throws \InvalidArgumentException
     */
    private function _assertTypesAreUnique(TypeCollection $types)
    {
        if (count($types->unique()) !== count($types))
            throw new InvalidArgumentException('There is a duplicate type in the list of types');
    }

    /**
     * @param EggGroupCollection $eggGroups
     * @throws \InvalidArgumentException
     */
    private function _assertEggGroupsAreUnique(EggGroupCollection $eggGroups)
    {
        if (count($eggGroups->unique()) !== count($eggGroups))
            throw new InvalidArgumentException('There is a duplicate egg group in the list of egg groups');
    }
}