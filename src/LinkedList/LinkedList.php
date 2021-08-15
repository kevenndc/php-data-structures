<?php

namespace Kvnn\LinkedList;

use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use Kvnn\LinkedList\Node;

class LinkedList implements IteratorAggregate, Countable
{
    /**
     * @var Node $first
     * 
     * Stores the reference to the first Node of the list.
     */
    private ?Node $first;

    /**
     * @var Node $last
     * 
     * Stores the reference to the last Node of the list.
     */
    private ?Node $last;

    /**
     * @var int $length
     * 
     * Stores the current number of elements in the list.
     */
    private int $length;


    public function __construct()
    {
        $this->first = null;
        $this->last = null;
        $this->length = 0;
    }

    public function getIterator()
    {
        return new LinkedListIterator($this);
    }

    public function fromArray(array $array)
    {
        if (count($array) <= 0) {
            throw new InvalidArgumentException('The array must have at least one element.');
        }

        foreach ($array as $item) {
            $this->append($item);
        }

        return $this;
    }

    /**
     * Inserts the data passed at the end of the list.
     * 
     * @param mixed $data
     * @return LinkedList
     */
    public function append(mixed $data): LinkedList
    {
        if ($this->isEmpty()) {
            return $this->insertFirst($data);
        }

        $newNode = new Node($data);
        $this->last->setNext($newNode);
        $this->last = $newNode;
        $this->length++;

        return $this;
    }

    /**
     * Utility function for inserting the first element in the list if the list is empty.
     * 
     * @param mixed $data The data to be inserted in the first Node.
     */
    private function insertFirst(mixed $data): LinkedList
    {
        $this->first = new Node($data);
        $this->last = $this->first;
        $this->length++;

        return $this;
    }

    /**
     * Inserts the data passed at the beginning of the list.
     * 
     * @param mixed $data The data to be inserted at the beginning of the list
     * @return LinkedList
     */
    public function prepend(mixed $data): LinkedList
    {
        if ($this->isEmpty()) {
            return $this->insertFirst($data);
        }

        $node = new Node($data);
        $node->setNext($this->first);
        $this->first = $node;
        $this->length++;
        
        return $this;
    }

    /**
     * Inserts data in a specific index of the list.
     * 
     * @param int $index The index where the data will be inserted.
     * @param mixed $data The  data that will be inserted.
     * 
     * @throws OutOfBoundsException
     * 
     * @return void
     */
    public function insert(int $index, mixed $data): LinkedList
    {
        if ($index < 0 || $index > $this->length)  {
            throw new \OutOfBoundsException("Index out of bounds.");
        }

        if ($index === 0) {
            return $this->prepend($data);
        } 

        if ($index === $this->length) {
            return $this->append($data);
        }

        return $this->insertInTheMiddle($data, $index);
    }

    private function insertInTheMiddle($data, $index) 
    {
        $newNode = new Node($data);
        $current = $this->first;
        $prev = null;

        for ($i = 0; $i < $index; $i++) { 
            $prev = $current;
            $current = $current->getNext();
        }

        $newNode->setNext($current);
        $prev->setNext($newNode);
        $this->length++;

        return $this;
    }

    /**
     * Return the current element in a specific index.
     * 
     * @param $index The index of the element that should be returned
     * 
     * @throws OutOfBoundsException
     * 
     * @return mixed
     */
    public function get(int $index): mixed
    {
        if ($index < 0 || $index > $this->length || $this->isEmpty()) {
            throw new \OutOfBoundsException("Index out of bounds.");
        }

        $current = $this->first;

        for ($i = 0; $i < $index; $i++) {
            if ($current->getNext() === null) {
                return null;
            }
            $current = $current->getNext();
        }

        return $current->getData();
    }

    /**
     * Finds and returns the index of an element if it exists.
     *
     * @param mixed $data
     * @return int|false
     */
    public function indexOf($data): int
    {
        $current = $this->first;

        for ($i = 0; $i < $this->length; $i++) {
            if ($data === $current->getData()) {
                return $i;
            }

            $current = $current->getNext();
        }

        return -1;
    }

     /**
     * Clear all data of the List.
     * 
     * @return void
     */
    public function clear()
    {
        $this->first = null;
        $this->last = null;
        $this->length = 0;
    }

    /**
     * Return the number os elements in the list.
     * 
     * @return int
     */
    public function count(): int
    {
        return $this->length;
    }

    /**
     * Return True if the list is empty and False if it has any elements.
     * 
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->length === 0;
    }

    public function first(): mixed
    {
        return $this->first;
    }

    public function last(): mixed
    {
        return $this->last;
    }

    public function exists(mixed $data): bool
    {
        return $this->indexOf($data) > -1;
    }

    public function remove(mixed $data)
    {
        $current = $this->first;

        if ($current->getData() === $data) {
            $this->first = $current->getNext();
            $this->length--;
            return $this;
        }

        $prev = null;

        while ($current->getData() !== $data) {
            if ($current === null) {
                return -1;
            }

            $prev = $current;
            $current = $current->getNext();
        }

        $prev->setNext($current->getNext());
        $this->length--;
        return $this;
    }

    /**
     * Returns a string with all elements of the list.
     * 
     * @return string
     */
    public function __toString(): string
    {
        $items = '';
        $current = $this->first;
        $index = 0;

        for ($i = 0; $index < $this->length; $i++) {
            $items .= "\t [$index] => {$current->getData()}" . PHP_EOL;
            $current = $current->getNext();
            $index++;
        }

        return "LinkedList {\n $items }";
    }
}