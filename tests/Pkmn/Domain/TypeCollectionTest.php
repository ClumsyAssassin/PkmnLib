<?php

namespace Pkmn\Domain;

class TypeCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateInvalidCollection()
    {
        $this->setExpectedException('InvalidArgumentException');
        new TypeCollection(array(new Type(Type::ELECTRIC), new \stdClass()));
    }

    public function testCreateCollection()
    {
        $collection = new TypeCollection(new Type(Type::NORMAL));
        $this->assertEquals('normal', $collection[0]);
    }
}