<?php

namespace Pkmn\Domain;

class EggGroupCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateInvalidCollection()
    {
        $this->setExpectedException('InvalidArgumentException');
        new EggGroupCollection(array(new EggGroup(EggGroup::BUG), new \stdClass()));
    }

    public function testCreateCollection()
    {
        $collection = new EggGroupCollection(new EggGroup(EggGroup::BUG));
        $this->assertEquals('bug', $collection[0]);
    }
}