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
    private static $_validTypes = array(self::NORMAL, self::FIRE, self::FIGHTING, self::WATER, self::FLYING,
        self::GRASS, self::POISON, self::ELECTRIC, self::GROUND, self::PSYCHIC, self::ROCK, self::ICE, self::BUG,
        self::DRAGON, self::GHOST, self::DARK, self::STEEL, self::FAIRY,
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