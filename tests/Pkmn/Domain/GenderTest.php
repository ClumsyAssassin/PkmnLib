<?php

namespace Pkmn\Domain;

class GenderTest extends \PHPUnit_Framework_TestCase
{
    /** @var Gender */
    private $_gender;

    protected function setUp()
    {
        $this->_gender = new Gender(Gender::MALE);
    }

    public function testCreateInvalidGender()
    {
        $this->setExpectedException('\Pkmn\Exception\InvalidGender');
        new Gender('badGender');
    }

    public function testToStringReturnsMale()
    {
        $this->assertEquals('male', $this->_gender);
        $this->assertEquals('male', $this->_gender->getGender());
    }
}