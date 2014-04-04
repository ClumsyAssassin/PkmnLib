<?php

namespace Pkmn\Domain;

use Pkmn\Exception\InvalidEggGroup;

class EggGroup
{
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

    /** @var array */
    private static $_validEggGroups = array(self::EGG_GROUP_MONSTER, self::EGG_GROUP_WATER1, self::EGG_GROUP_BUG,
        self::EGG_GROUP_FLYING, self::EGG_GROUP_FIELD, self::EGG_GROUP_FAIRY, self::EGG_GROUP_GRASS,
        self::EGG_GROUP_HUMAN_LIKE, self::EGG_GROUP_WATER3, self::EGG_GROUP_MINERAL, self::EGG_GROUP_AMORPHOUS,
        self::EGG_GROUP_WATER2, self::EGG_GROUP_DITTO, self::EGG_GROUP_DRAGON, self::EGG_GROUP_UNDISCOVERED,
    );

    /** @var string */
    private $_eggGroup;

    /**
     * @param string $eggGroup
     * @throws \InvalidArgumentException
     */
    public function __construct($eggGroup)
    {
        if (in_array($eggGroup, static::$_validEggGroups))
            throw new InvalidEggGroup($eggGroup);
        $this->_eggGroup = $eggGroup;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->_eggGroup;
    }

    /**
     * @return string
     */
    public function getEggGroup()
    {
        return $this->_eggGroup;
    }
} 