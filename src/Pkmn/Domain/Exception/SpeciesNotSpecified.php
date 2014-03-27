<?php

namespace Pkmn\Domain\Exception;

class SpeciesNotSpecified extends \RuntimeException
{
    protected $message = 'Species of the monster is not specified';
} 