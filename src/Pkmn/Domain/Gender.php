<?php

namespace Pkmn\Domain;

use Pkmn\Exception\InvalidGender;

class Gender
{
    const MALE = 'male';
    const FEMALE = 'female';
    const GENDERLESS = 'genderless';

    /** @var array */
    private static $_validGenders = array(self::MALE, self::FEMALE, self::GENDERLESS);

    /** @var string */
    private $_gender;

    /**
     * @param string $gender
     * @throws \InvalidArgumentException
     */
    public function __construct($gender)
    {
        if (!in_array($gender, static::$_validGenders))
            throw new InvalidGender();
        $this->_gender = $gender;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->_gender;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->_gender;
    }
} 