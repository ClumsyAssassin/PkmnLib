<?php

namespace Pkmn\Domain\Service;

use InvalidArgumentException;

class Transferer
{
    /**
     * @param Monster $monster
     * @param int $generation
     * @throws InvalidArgumentException
     * @return bool
     */
    public function canTransfer(Monster $monster, $generation)
    {
        if (!is_int($generation))
            throw new InvalidArgumentException("Generation '{$generation}' should be an int");

        $monsterGeneration = $monster->getGeneration();
        return ($monsterGeneration == $generation)
            || ($monsterGeneration == 1 && $generation == 2)
            || ($monsterGeneration >= 3 && $monsterGeneration <= $generation);
    }
} 