<?php

namespace Pkmn\Exception;

use InvalidArgumentException;

class InvalidType extends InvalidArgumentException
{
    protected $message = 'Type is invalid';
} 