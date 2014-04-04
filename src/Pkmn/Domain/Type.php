<?php

namespace Pkmn\Domain;

use InvalidArgumentException;
use Pkmn\Exception\InvalidType;

class Type
{
    const NORMAL = 'normal';
    const FIRE = 'fire';
    const FIGHTING = 'fighting';
    const WATER = 'water';
    const FLYING = 'flying';
    const GRASS = 'grass';
    const POISON = 'poison';
    const ELECTRIC = 'electric';
    const GROUND = 'ground';
    const PSYCHIC = 'psychic';
    const ROCK = 'rock';
    const ICE = 'ice';
    const BUG = 'bug';
    const DRAGON = 'dragon';
    const GHOST = 'ghost';
    const DARK = 'dark';
    const STEEL = 'steel';
    const FAIRY = 'fairy';

    /** @var array */
    private static $_validTypes = array(self::TYPE_NORMAL, self::TYPE_FIRE, self::TYPE_FIGHTING, self::TYPE_WATER,
        self::TYPE_FLYING, self::TYPE_GRASS, self::TYPE_POISON, self::TYPE_ELECTRIC, self::TYPE_GROUND,
        self::TYPE_PSYCHIC, self::TYPE_ROCK, self::TYPE_ICE, self::TYPE_BUG, self::TYPE_DRAGON, self::TYPE_GHOST,
        self::TYPE_DARK, self::TYPE_STEEL, self::TYPE_FAIRY,
    );

    /** @var string */
    private $_type;

    /**
     * @param string $type
     * @throws InvalidArgumentException
     */
    public function __construct($type)
    {
        if (!in_array($type, static::$_validTypes))
            throw new InvalidType($type);
        $this->_type = $type;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->_type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }
}