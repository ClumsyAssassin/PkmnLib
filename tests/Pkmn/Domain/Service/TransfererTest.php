<?php

namespace Pkmn\Domain\Service;

use Pkmn\Domain\EggGroup;
use Pkmn\Domain\EggGroupCollection;
use Pkmn\Domain\Gender;
use Pkmn\Domain\Monster;
use Pkmn\Domain\Type;
use Pkmn\Domain\TypeCollection;

class TransfererTest extends \PHPUnit_Framework_TestCase
{
    /** @var Transferer */
    private $_transferer;

    /** @var Gender */
    private $_gender;

    /** @var EggGroupCollection */
    private $_eggGroupCollection;

    /** @var TypeCollection */
    private $_typeCollection;

    protected function setUp()
    {
        $this->_gender = new Gender(Gender::MALE);
        $this->_eggGroupCollection = new EggGroupCollection(new EggGroup(EggGroup::MONSTER));
        $this->_typeCollection = new TypeCollection(new Type(Type::BUG));
        $this->_transferer = new Transferer();
    }

    public function testCanTransferMonsterToOtherGenerations()
    {
        $this->_assertCanTransferFromGenXToGenerations(1, array(1, 2));
        $this->_assertCannotTransferFromGenXToGenerations(1, array(3, 4, 5, 6));

        $this->_assertCanTransferFromGenXToGenerations(2, array(2));
        $this->_assertCannotTransferFromGenXToGenerations(2, array(1, 3, 4, 5, 6));

        $this->_assertCanTransferFromGenXToGenerations(3, array(3, 4, 5, 6));
        $this->_assertCannotTransferFromGenXToGenerations(3, array(1, 2));

        $this->_assertCanTransferFromGenXToGenerations(4, array(4, 5, 6));
        $this->_assertCannotTransferFromGenXToGenerations(4, array(1, 2, 3));

        $this->_assertCanTransferFromGenXToGenerations(5, array(5, 6));
        $this->_assertCannotTransferFromGenXToGenerations(5, array(1, 2, 3, 4));

        $this->_assertCanTransferFromGenXToGenerations(6, array(6));
        $this->_assertCannotTransferFromGenXToGenerations(6, array(1, 2, 3, 4, 5));
    }

    /**
     * @param int $genX
     * @param int[] $generations
     */
    private function _assertCanTransferFromGenXToGenerations($genX, $generations)
    {
        $this->_assertTransferFromGenXToGenerations($genX, $generations, true);
    }

    /**
     * @param int $genX
     * @param int[] $generations
     */
    private function _assertCannotTransferFromGenXToGenerations($genX, $generations)
    {
        $this->_assertTransferFromGenXToGenerations($genX, $generations, false);
    }

    /**
     * @param int $genX
     * @param int[] $generations
     * @param bool $assertTrue
     */
    private function _assertTransferFromGenXToGenerations($genX, $generations, $assertTrue)
    {
        $monster = new Monster('name', $this->_gender, $genX, $this->_eggGroupCollection, $this->_typeCollection);
        foreach ($generations as $genY)
            if ($assertTrue)
                $this->assertTrue($this->_transferer->canTransfer($monster, $genY));
            else
                $this->assertFalse($this->_transferer->canTransfer($monster, $genY));
    }
}
 