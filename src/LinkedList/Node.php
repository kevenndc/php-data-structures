<?php

namespace Kvnn\LinkedList;

class Node
{
    /**
     * @var mixed $data
     * 
     * Stores the data of the current Node.
     */
    private mixed $data;

    /**
     * @var Node $next
     * 
     * Stores the reference to the next Node of the list.
     */
    private Node $next;


    public function __construct(mixed $data = null)
    {
        $this->data = $data;
        $this->next = null;
    }

    /**
     * Stores the data in the current Node.
     * 
     * @param mixed $data The data to be stored in the current Node.
     * 
     * @return void
     */
    public function setData(mixed $data)
    {
        $this->data = $data;
    }

    /**
     * Stores the reference to the next Node of the list.
     * 
     * @param Node $next The next Node in the list that should be referenced.
     * 
     * @return void
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
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * Returns the reference of the next Node.
     * 
     * @return Node
     */
    public function getNext(): Node
    {
        return $this->next;
    }

    /**
     * Returns a string with the Node data
     * 
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->data;
    }
}