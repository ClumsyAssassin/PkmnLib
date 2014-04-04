<?php

namespace Pkmn\Domain;

class Monster
{
    const MALE = 'male';
    const FEMALE = 'female';
    const GENDERLESS = 'genderless';

    const MIN_NUM_EGG_GROUPS = 1;
    const MAX_NUM_EGG_GROUPS = 2;

    const EGG_GROUP_MONSTER = 'monster';
    const EGG_GROUP_WATER1 = 'water1';
    const EGG_GROUP_BUG = 'bug';
    const EGG_GROUP_FLYING = 'flying';
    const EGG_GROUP_FIELD = 'field';
    const EGG_GROUP_FAIRY = 'fairy';
    const EGG_GROUP_GRASS = 'grass';
    const EGG_GROUP_HUMAN_LIKE = 'human-like';
    const EGG_GROUP_WATER3 = 'water3';
    const EGG_GROUP_MINERAL = 'mineral';
    const EGG_GROUP_AMORPHOUS = 'amorphous';
    const EGG_GROUP_WATER2 = 'water2';
    const EGG_GROUP_DITTO = 'ditto';
    const EGG_GROUP_DRAGON = 'dragon';
    const EGG_GROUP_UNDISCOVERED = 'undiscovered';

    /** @var string */
    private $_name;

    /** @var string */
    private $_gender;

    /** @var int */
    private $_generation;

    /** @var array */
    private $_eggGroups;

    /** @var array */
    private static $_validGenders = array(self::MALE, self::FEMALE, self::GENDERLESS);

    /** @var array */
    private static $_validEggGroups = array(self::EGG_GROUP_MONSTER, self::EGG_GROUP_WATER1, self::EGG_GROUP_BUG,
        self::EGG_GROUP_FLYING, self::EGG_GROUP_FIELD, self::EGG_GROUP_FAIRY, self::EGG_GROUP_GRASS,
        self::EGG_GROUP_HUMAN_LIKE, self::EGG_GROUP_WATER3, self::EGG_GROUP_MINERAL, self::EGG_GROUP_AMORPHOUS,
        self::EGG_GROUP_WATER2, self::EGG_GROUP_DITTO, self::EGG_GROUP_DRAGON, self::EGG_GROUP_UNDISCOVERED,
    );

    /**
     * @param string $name
     * @param string $gender
     * @param int $generation
     * @param array $eggGroups
     * @throws \InvalidArgumentException
     */
    public function __construct($name, $gender, $generation, array $eggGroups)
    {
        $this->_assertParametersAreValid($name, $gender, $generation, $eggGroups);

        $this->_name = $name;
        $this->_gender = $gender;
        $this->_generation = $generation;
        $this->_eggGroups = $eggGroups;
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
     * @throws \InvalidArgumentException
     */
    private function _assertEggGroupsWithinBounds(array $eggGroups)
    {
        $numEggGroups = count($eggGroups);
        if ($numEggGroups > self::MAX_NUM_EGG_GROUPS)
            throw new \InvalidArgumentException("Number of egg groups is more than max " . self::MAX_NUM_EGG_GROUPS);
        else if ($numEggGroups < self::MIN_NUM_EGG_GROUPS)
            throw new \InvalidArgumentException("Number of egg groups is less than min " . self::MIN_NUM_EGG_GROUPS);
    }

    /**
     * @param array $eggGroups
     * @throws \InvalidArgumentException
     */
    private function _assertValidEggGroups(array $eggGroups)
    {
        foreach ($eggGroups as $eggGroup) {
            if (!in_array($eggGroup, static::$_validEggGroups))
                throw new \InvalidArgumentException("Egg group '{$eggGroup}' is invalid");
        }
    }

    /**
     * @param string $name
     * @param string $gender
     * @param array $eggGroups
     * @throws \InvalidArgumentException
     */
    private function _assertValidDitto($name, $gender, array $eggGroups)
    {
        if (count($eggGroups) > 1)
            throw new \InvalidArgumentException("Ditto egg group cannot be combined with another egg group");
        else if ($name != 'Ditto')
            throw new \InvalidArgumentException("Ditto egg group can only be assigned to monster named Ditto");
        else if ($gender != self::GENDERLESS)
            throw new \InvalidArgumentException("Ditto egg group can only be assigned to genderless monster");
    }

    /**
     * @param array $eggGroups
     * @throws \InvalidArgumentException
     */
    private function _assertValidUndiscovered(array $eggGroups)
    {
        if (count($eggGroups) > 1)
            throw new \InvalidArgumentException("Undiscovered egg group cannot be combined with another egg group");
    }

    /**
     * @param $name
     * @param $gender
     * @param $generation
     * @param array $eggGroups
     * @throws \InvalidArgumentException
     */
    private function _assertParametersAreValid($name, $gender, $generation, array $eggGroups)
    {
        if (!is_string($name))
            throw new \InvalidArgumentException("Name '{$name}' must be a string");

        if (!in_array($gender, static::$_validGenders))
            throw new \InvalidArgumentException("Gender '{$gender}' is invalid");

        if (!is_int($generation))
            throw new \InvalidArgumentException("Generation '{$generation}' must be an integer");

        $this->_assertEggGroupsWithinBounds($eggGroups);
        if (in_array(self::EGG_GROUP_DITTO, $eggGroups))
            $this->_assertValidDitto($name, $gender, $eggGroups);
        elseif (in_array(self::EGG_GROUP_UNDISCOVERED, $eggGroups))
            $this->_assertValidUndiscovered($eggGroups);
        else
            $this->_assertValidEggGroups($eggGroups);
    }
}