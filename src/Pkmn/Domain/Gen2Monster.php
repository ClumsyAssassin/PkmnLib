<?php

namespace Pkmn\Domain;

class Gen2Monster extends Monster
{
    /** @var int */
    protected $_generation = 2;

    /** @var int  */
    protected $_lastGenerationCanTransferTo = 2;
} 