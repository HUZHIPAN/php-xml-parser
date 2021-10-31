<?php


namespace xml\parser\common;


use xml\parser\common\interfaces\PeekIterator;


/**
 * @notice: 可预览下一个元素的迭代器（字符串实现）
 * @package xml\parser\common
 *
 * @author HUZHIPAN <huzhipan@lwops.cn>
 * @time 2021/10/30 13:13
 */
class StringPeekIterator implements PeekIterator
{
    private $string;      // 迭代字符串
    private $pointer;     // 指针位置
    private $end_pointer; // 尾指针


    public function __construct($string)
    {
        $this->string      = $string;
        $this->pointer     = 0;
        $this->end_pointer = strlen($string);
    }

    public function next()
    {
        return $this->string[$this->pointer++];
    }

    public function hasNext()
    {
        return $this->pointer < $this->end_pointer;
    }

    public function peek()
    {
        return $this->string[$this->pointer];
    }

    public function peekPrev()
    {
        return  $this->string[$this->pointer-2];
    }

    public function getPointer()
    {
        return $this->pointer;
    }


}