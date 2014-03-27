<?php

namespace Pkmn\Domain;

class Gen2Monster extends Monster
{
    /** @var int */
    protected $_generation = 2;

    /**
     * @param Monster $partner
     * @return boolean
     */
    public function canBreedWith(Monster $partner)
    {


        // 1. Generation issues (cannot breed with pokemon i cant transfer to)
        // 2. If legendary -> no
        // 3. If self/partner is ditto -> yes
        // 4. If im male/female, partner female/male, neither is baby, and share an egg group -> yes
        // Gen2 to Gen3 -> yes
        // Gen3 to Gen4 -> yes
        // Gen4 to Gen5 -> yes
        // Gen5 to Gen6 -> yes
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
        return ($generation == 2);
    }
} 