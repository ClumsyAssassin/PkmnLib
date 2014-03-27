<?php

namespace Pkmn\Domain\Exception;

class GenderNotSpecified extends \RuntimeException
{
    protected $message = 'Gender of the monster is not specified';
} 