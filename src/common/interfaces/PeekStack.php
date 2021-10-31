<?php


namespace xml\parser\common\interfaces;


/**
 * 可重复读的栈
 * @package xml\parser\common\interfaces
 */
interface PeekStack
{
    // 压栈
    public function push($e);

    // 出栈
    public function pop();

    // 查看栈顶元素
    public function peek();

    // 栈中是否有元素
    public function isEmpty();


}