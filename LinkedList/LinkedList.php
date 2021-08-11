<?php

include __DIR__ . '/Node.php';

class LinkedList
{
    /**
     * @var Node $first
     * 
     * Stores the reference to the first Node of the list.
     */
    private $first;

    /**
     * @var Node $last
     * 
     * Stores the reference to the last Node of the list.
     */
    private $last;

    /**
     * @var int $count
     * 
     * Stores the current number of elements in the list.
     */
    private $count;


    public function __construct()
    {
        $this->first = null;
        $this->last = null;
        $this->count = 0;
    }

    /**
     * Inserts the data passed at the end of the list.
     * 
     * @param mixed $data
     * @return LinkedList
     */
    public function append(mixed $data)
    {
        if ($this->isEmpty()) {
            return $this->insertFirst($data);
        }

        $newNode = new Node($data);
        $this->last->setNext($newNode);
        $this->last = $newNode;
        $this->count++;
        return $this;
    }

    /**
     * Utility function for inserting the first element in the list if the list is empty.
     * 
     * @param Node $data The data to be inserted in the first Node.
     */
    private function insertFirst(mixed $data)
    {
        $this->first = new Node($data);
        $this->last = $this->first;
        $this->count++;
        return $this;
    }

    /**
     * Inserts the data passed at the beginning of the list.
     * 
     * @param mixed $data The data to be inserted at the beginning of the list
     * @return LinkedList
     */
    public function prepend(mixed $data)
    {
        if ($this->isEmpty()) {
            return $this->insertFirst($data);
        }

        $node = new Node($data);
        $node->setNext($this->first);
        $this->first = $node;
        $this->count++;
        
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
    public function insert(int $index, mixed $data)
    {
        if ($index < 0 || $index > $this->count)  {
            throw new OutOfBoundsException("Index out of bounds.");
        }

        if ($index === 0) {
            return $this->prepend($data);
        } 

        if ($index === $this->count) {
            return $this->append($data);
        }

        $this->insertInTheMiddle($data, $index);

        return $this;
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
        $this->count++;
    }

    /**
     * Return the current element in a specific index.
     * 
     * @param $index The index of the element that should be returned
     * 
     * @throws OutOfBoundsException
     * 
     * @return Node
     */
    public function get(int $index)
    {
        if ($index < 0 || $index > $this->count || $this->isEmpty()) {
            throw new OutOfBoundsException("Index out of bounds.");
        }

        $current = $this->first;

        for ($i = 0; $i < $index; $i++) { 
            $current = $current->getNext();
        }

        return $current;
    }

    public function indexOf($data)
    {
        $current = $this->first;

        for ($i = 0; $i < $this->count; $i++) {
            if ($data === $current->getData()) {
                return $i;
            }

            $current = $current->getNext();
        }

        return false;
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
        $this->count = 0;
    }

    /**
     * Return the number os elements in the list.
     * 
     * @return int
     */
    public function size()
    {
        return $this->count;
    }

    /**
     * Return True if the list is empty and False if it has any elements.
     * 
     * @return bool
     */
    public function isEmpty()
    {
        return $this->count === 0;
    }

    /**
     * Returns a string with all elements of the list.
     * 
     * @return string
     */
    public function __toString()
    {
        $items = '';
        $current = $this->first;
        $index = 0;

        for ($i = 0; $index < $this->count; $i++) {
            $items .= "\t [$index] => {$current->getData()}" . PHP_EOL;
            $current = $current->getNext();
            $index++;
        }

        return "LinkedList {\n $items }";
    }

    
}