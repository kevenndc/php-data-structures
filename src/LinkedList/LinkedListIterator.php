<?php

namespace Kvnn\LinkedList;

use Iterator;

class LinkedListIterator implements Iterator
{
    private LinkedList $list;

    private int $currentIndex;

    public function __construct(LinkedList $list)
    {
        $this->list = $list;
    }

    public function current()
    {
        return $this->list->get($this->currentIndex);
    }

    public function key()
    {
        return $this->currentIndex;
    }

    public function next()
    {
        return ++$this->currentIndex;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid()
    {
        return $this->list->get($this->currentIndex) !== null;
    }
}