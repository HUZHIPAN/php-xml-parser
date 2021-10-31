<?php


namespace xml\parser\syntax\statement;


use xml\parser\common\ArrayPeekIterator;
use xml\parser\lexer\Token;
use xml\parser\parser\Context;
use xml\parser\syntax\SyntaxException;

/**
 * @notice: 语句执行抽象类
 * @package xml\parser\syntax\statement
 *
 * @author HUZHIPAN <huzhipan@lwops.cn>
 * @time 2021/10/30 23:38
 */
abstract class StatementAbstract
{
    protected $it; // 词法单元迭代器

    public function __construct($tokens)
    {
        $this->it = new ArrayPeekIterator($tokens);
    }

    /**
     * Notice: 语句执行
     * @param $context Context 程序执行上下文
     * @return mixed
     *
     * Author: huzhipan
     * Time: 2021/10/31 15:17
     */
    public abstract function run(Context $context);

    /**
     * Notice: 消耗一个指定单元
     *
     * Author: huzhipan
     * Time: 2021/10/30 22:55
     * @param $tokenType
     * @return string
     * @throws SyntaxException
     */
    public function consume($tokenType)
    {
        if (!$this->getIterator()->hasNext()) {
            throw new SyntaxException('语义错误，' . ' 期待 ' .$tokenType);
        }
        $token = $this->getIterator()->next();
        if ($token->getType() !== $tokenType) {
            throw new SyntaxException('语法错误， 意外的：' . $token->getValue() .
                ' 期待 ' .$tokenType
            );
        }
        return $token->getValue();
    }

    public function getIterator()
    {
        return $this->it;
    }


}