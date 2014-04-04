<?php

namespace Base\Domain;

use Base\Domain\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    /** @var Collection */
    private $_collection;

    public function setUp()
    {
        $this->_collection = new Collection();
    }

    public function testCreateCollectionOfObjectsWithASingleObject()
    {
        new Collection(new \stdClass());
    }

    public function testCreateCollectionOfObjectsFromArray()
    {
        new Collection(array(new \stdClass(), new \stdClass(), new \stdClass()));
    }

    public function testAddingNewElementToCollection()
    {
        $this->_collection[] = new \stdClass();
        $this->_collection->append(new \stdClass());
    }

    public function testSettingAnOffset()
    {
        $this->_collection->offsetSet(0, new \stdClass());
        $this->_collection[0] = new \stdClass();
    }
}
 