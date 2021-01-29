<?php

class Node
{
    /**
     * @var mixed $data
     * 
     * Stores the data of the current Node.
     */
    private $data;

    /**
     * @var Node $next
     * 
     * Stores the reference to the next Node of the list.
     */
    private $next;


    public function __construct(mixed $data = null)
    {
        $this->data = $data;
        $this->next = null;
    }

    /**
     * Stores the data in the current Node.
     * 
     * @param mixed $data The data to be stored in the current Node.
     */
    public function setData(mixed $data)
    {
        $this->data = $data;
    }

    /**
     * Stores the reference to the next Node of the list.
     * 
     * @param Node $next The next Node in the list that should be referenced.
     */
    public function setNext(Node $next)
    {
        $this->next = $next;
    }

    /**
     * Returns the data stored in the Node.
     * 
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Returns the reference of the next Node.
     * 
     * @return Node
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * Returns a string with the Node data
     * 
     * @return string
     */
    public function __toString()
    {
        return (string) $this->data;
    }
}

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
     * @return void
     */
    public function append(mixed $data)
    {
        if ($this->isEmpty()) {
            $this->insertFirst($data);
        } 
        else {  
            $newNode = new Node($data);
            $this->last->setNext($newNode);
            $this->last = $newNode;
        }
        $this->count++;
    }

    /**
     * Inserts the data passed at the beginning of the list.
     * 
     * @param mixed $data The data to be inserted at the beginning of the list
     * @return void
     */
    public function prepend(mixed $data)
    {
        if ($this->isEmpty()) {
            $this->insertFirst($data);
        } 
        else {
            $node = new Node($data);
            $node->setNext($this->first);
            $this->first = $node;
        }
        $this->count++; 
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
            $this->prepend($data);
        } 
        elseif ($index === $this->count) {
            $this->append($data);
        } 
        else {
            $node = new Node($data);
            $current = $this->first;
            $prev = null;

            for ($i=0; $i < $index; $i++) { 
                $prev = $current;
                $current = $current->getNext();
            }

            $node->setNext($current);
            $prev->setNext($node);

            $this->count++;
        }    
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

        for ($i=0; $i < $index; $i++) { 
            $current = $current->getNext();
        }
        return $current;
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
        return $this->count === 0 ? TRUE : FALSE;
    }

    /**
     * Returns a string with all elements of the list.
     * 
     * @return string
     */
    public function __toString()
    {
        $output = '';
        $current = $this->first;

        while ($current !== null) {
            $output .= $current->getData() . PHP_EOL;
            $current = $current->getNext();
        }
        return $output;
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
    }
}