<?php

namespace Pkmn\Domain\Service;

use Pkmn\Domain\EggGroup;
use Pkmn\Domain\Gender;
use Pkmn\Domain\Monster;

class Breeder
{
    /**
     * @param Monster $monsterA
     * @param Monster $monsterB
     * @return bool
     */
    public function canBreed(Monster $monsterA, Monster $monsterB)
    {
        return $this->_canTransferToSameGen($monsterA, $monsterB)
        && $this->_notUndiscoveredEggGroup($monsterA, $monsterB)
        && (
            ($this->_oppositeGenders($monsterA, $monsterB) && $this->_shareAnEggGroup($monsterA, $monsterB))
            || ($this->_isDitto($monsterA) xor $this->_isDitto($monsterB))
        );
    }

    /**
     * @param Monster $monsterA
     * @param Monster $monsterB
     * @return bool
     */
    private function _oppositeGenders(Monster $monsterA, Monster $monsterB)
    {
        return ($monsterA->getGender() == Gender::MALE && $monsterB->getGender() == Gender::FEMALE)
        || ($monsterA->getGender() == Gender::FEMALE && $monsterB->getGender() == Gender::MALE);
    }

    /**
     * @param Monster $monsterA
     * @param Monster $monsterB
     * @return bool
     */
    private function _shareAnEggGroup(Monster $monsterA, Monster $monsterB)
    {
        $eggGroups = $monsterA->getEggGroups();
        $intersection = $eggGroups->intersect($monsterB->getEggGroups());
        return count($intersection) != 0;
    }

    /**
     * @param Monster $monsterA
     * @param Monster $monsterB
     * @return bool
     */
    private function _notUndiscoveredEggGroup(Monster $monsterA, Monster $monsterB)
    {
        return !$monsterA->getEggGroups()->inCollection(EggGroup::UNDISCOVERED)
        && !$monsterB->getEggGroups()->inCollection(EggGroup::UNDISCOVERED);
    }

    /**
     * @param Monster $monster
     * @return bool
     */
    private function _isDitto(Monster $monster)
    {
        return $monster->getEggGroups()->inCollection(EggGroup::DITTO);
    }

    /**
     * @param Monster $monsterA
     * @param Monster $monsterB
     * @return bool
     */
    private function _canTransferToSameGen(Monster $monsterA, Monster $monsterB)
    {
        $transferer = new Transferer();
        return $transferer->canTransfer($monsterA, $monsterB->getGeneration()) || $transferer->canTransfer($monsterB, $monsterA->getGeneration());
    }
}