<?php


namespace xml\parser\common;


use xml\parser\common\interfaces\PeekIterator;

/**
 * @notice: 可预览下一个元素的迭代器（数组实现）
 * @package xml\parser\common
 *
 * @author HUZHIPAN <huzhipan@lwops.cn>
 * @time 2021/10/30 13:13
 */
class ArrayPeekIterator implements PeekIterator
{
    private $array;       // 迭代数组
    private $pointer;     // 当前指针
    private $end_pointer; // 尾指针


    public function __construct($array)
    {
        $this->array       = $array;
        $this->pointer     = 0;
        $this->end_pointer = count($array);
    }

    public function next()
    {
        return $this->array[$this->pointer++];
    }

    public function hasNext()
    {
        return $this->pointer < $this->end_pointer;

    }

    public function peek()
    {
//        if (!isset($this->array[$this->pointer])) {
//            $a = 1;
//            return $this->array[$this->pointer-1];
//        }
        return $this->array[$this->pointer];
    }




}