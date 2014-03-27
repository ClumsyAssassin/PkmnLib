<?php

namespace Pkmn\Domain\Exception;

class GenerationNotSpecified extends \RuntimeException
{
    protected $message = 'Generation of the monster is not specified';
} 