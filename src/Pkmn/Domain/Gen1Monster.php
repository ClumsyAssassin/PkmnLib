<?php

namespace Pkmn\Domain;

class Gen1Monster extends Monster
{
    /** @var int */
    protected $_generation = 1;

    /**
     * @param Monster $partner
     * @return boolean
     */
    public function canBreedWith(Monster $partner)
    {
        return false;
    }

    /**
     * @param int $generation
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public function canTransferTo($generation)
    {
        if(!is_int($generation)) {
            throw new \InvalidArgumentException('Generation must be an integer');
        }
        return ($generation == 1 || $generation == 2);
    }
} 