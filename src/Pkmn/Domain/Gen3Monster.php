<?php

namespace Pkmn\Domain;

class Gen3Monster extends Monster
{
    /** @var int */
    protected $_generation = 3;

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
        return ($generation == $this->_generation);
    }
} 