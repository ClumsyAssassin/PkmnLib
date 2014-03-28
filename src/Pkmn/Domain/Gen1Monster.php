<?php

namespace Pkmn\Domain;

class Gen1Monster extends Monster
{
    /** @var int */
    protected $_generation = 1;

    /** @var int  */
    protected $_lastGenerationCanTransferTo = 2;
} 