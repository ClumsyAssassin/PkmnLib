<?php

namespace Pkmn\Domain\Exception;

class SpeciesNotSpecified extends \InvalidArgumentException
{
    protected $message = 'Species of the monster is not specified';
} 