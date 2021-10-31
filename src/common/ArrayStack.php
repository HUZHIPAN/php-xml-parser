<?php


namespace xml\parser\common;


use xml\parser\common\interfaces\PeekStack;

class ArrayStack implements PeekStack
{
    private $stack;

    public function __construct()
    {
        $this->stack = [];
    }

    public function push($e)
    {
        array_push($this->stack, $e);
    }

    public function pop()
    {
        return array_pop($this->stack);
    }

    public function peek()
    {
        return end($this->stack);
    }

    public function isEmpty()
    {
        return empty($this->stack);
    }
}