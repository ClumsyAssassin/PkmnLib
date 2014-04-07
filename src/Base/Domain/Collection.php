<?php

namespace Base\Domain;

class Collection extends \ArrayObject
{
    protected $_validInstance = '\stdClass';

    public function __construct($input = null, $flags = 0, $iterator_class = "ArrayIterator")
    {
        $passedInput = $input;
        if (isset($passedInput))
            $this->_assertValidInstances($passedInput);
        else
            $passedInput = array();

        if (!is_array($passedInput))
            $passedInput = array($passedInput);

        parent::__construct($passedInput, $flags, $iterator_class);
    }

    /**
     * @param mixed $value
     */
    public function append($value)
    {
        $this->_assertValidInstances($value);
        parent::append($value);
    }

    /**
     * @param mixed $input
     * @return array|void
     */
    public function exchangeArray($input)
    {
        $this->_assertValidInstances($input);
        return parent::exchangeArray($input);
    }

    /**
     * @param mixed $index
     * @param mixed $newval
     */
    public function offsetSet($index, $newval)
    {
        $this->_assertValidInstance($newval);
        parent::offsetSet($index, $newval);
    }

    public function inCollection($obj)
    {
        foreach ($this as $value)
            if ($obj == $value)
                return true;
        return false;
    }

    private function _assertValidInstances($values)
    {
        if (is_array($values))
            foreach ($values as $value)
                $this->_assertValidInstance($value);
        else
            $this->_assertValidInstance($values);
    }

    private function _assertValidInstance($value)
    {
        if (!is_a($value, $this->_validInstance))
            throw new \InvalidArgumentException("Argument is not an instance of " . $this->_validInstance);
    }
} 