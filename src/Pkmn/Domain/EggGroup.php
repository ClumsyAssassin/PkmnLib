<?php

namespace Pkmn\Domain;

use Pkmn\Exception\InvalidEggGroup;

class EggGroup
{
    const MONSTER = 'monster';
    const WATER1 = 'water1';
    const BUG = 'bug';
    const FLYING = 'flying';
    const FIELD = 'field';
    const FAIRY = 'fairy';
    const GRASS = 'grass';
    const HUMAN_LIKE = 'human-like';
    const WATER3 = 'water3';
    const MINERAL = 'mineral';
    const AMORPHOUS = 'amorphous';
    const WATER2 = 'water2';
    const DITTO = 'ditto';
    const DRAGON = 'dragon';
    const UNDISCOVERED = 'undiscovered';

    /** @var array */
    private static $_validEggGroups = array(self::MONSTER, self::WATER1, self::BUG, self::FLYING, self::FIELD,
        self::FAIRY, self::GRASS, self::HUMAN_LIKE, self::WATER3, self::MINERAL, self::AMORPHOUS, self::WATER2,
        self::DITTO, self::DRAGON, self::UNDISCOVERED,
    );

    /** @var string */
    private $_eggGroup;

    /**
     * @param string $eggGroup
     * @throws \InvalidArgumentException
     */
    public function __construct($eggGroup)
    {
        if (!in_array($eggGroup, static::$_validEggGroups))
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