<?php


namespace xml\parser\common\interfaces;

/**
 * 可预览下个元素的迭代器
 * @package xml\parser\common\interfaces
 */
interface PeekIterator
{
    /**
     * 将指针指向下一个并返回元素
     */
    public function next();

    /**
     * 是否存在下一个元素
     */
    public function hasNext();

    /**
     * 不移动指针查看下一个元素
     */
    public function peek();
}