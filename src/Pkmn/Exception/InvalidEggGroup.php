<?php

namespace Pkmn\Exception;

use InvalidArgumentException;

class InvalidEggGroup extends InvalidArgumentException
{
    protected $message = 'Egg group is invalid';
} 