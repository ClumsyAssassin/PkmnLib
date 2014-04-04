<?php

namespace Pkmn\Exception;

use InvalidArgumentException;

class InvalidGender extends InvalidArgumentException
{
    protected $message = 'Gender is invalid';
} 