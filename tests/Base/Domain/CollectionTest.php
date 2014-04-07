<?php

namespace Base\Domain;

use Base\Domain\Collection;
use stdClass;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    /** @var Collection */
    private $_collection;

    /** @var stdClass */
    private $_object;

    public function setUp()
    {
        $this->_object = new stdClass();
        $this->_object->test = 'test';
        $this->_collection = new Collection($this->_object);
    }

    public function testCreateCollectionOfObjectsWithASingleObject()
    {
        $this->assertEquals($this->_object, $this->_collection[0]);
    }

    public function testCreateCollectionOfObjectsFromArray()
    {
        $collection = new Collection(array($this->_object, $this->_object, $this->_object));
        $this->assertEquals(3, count($collection));
    }

    public function testAddingNewElementToCollection()
    {
        $newObj = new stdClass();
        $newObj->something = 'something';
        $this->_collection[] = $newObj;
        $this->assertEquals($newObj, $this->_collection[1]);
    }

    public function testSettingAnOffset()
    {
        $newObj = new stdClass();
        $newObj->somethingElse = 'somethingElse';
        $this->_collection[0] = $newObj;
        $this->assertEquals($newObj, $this->_collection[0]);
    }

    public function testCreateCollectionWithStrings()
    {
        $this->setExpectedException('InvalidArgumentException');
        new Collection('notObject');
    }

    public function testInCollection()
    {
        $this->assertTrue($this->_collection->inCollection($this->_object));
        $this->assertFalse($this->_collection->inCollection(new stdClass()));
    }

    public function testUniqueWithEmptyCollection()
    {
        $collection = new Collection();
        $this->assertEquals($collection, $collection->unique());
    }

    public function testUniqueWithDuplicates()
    {
        $newObj = new stdClass();
        $newObj->val = 'value';
        $this->_collection[] = $newObj;
        $this->_collection[] = $newObj;
        $this->assertEquals(3, count($this->_collection));
        $this->assertEquals(2, count($this->_collection->unique()));
    }
}