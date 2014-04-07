<?php

namespace Pkmn\Domain;

class TypeTest extends \PHPUnit_Framework_TestCase
{
    /** @var Type */
    private $_type;

    protected function setUp()
    {
        $this->_type = new Type(Type::BUG);
    }

    public function testCreateInvalidType()
    {
        $this->setExpectedException('\Pkmn\Exception\InvalidType');
        new Type('badType');
    }

    public function testToStringReturnsBugType()
    {
        $this->assertEquals('bug', $this->_type);
        $this->assertEquals('bug', $this->_type->getType());
    }
}