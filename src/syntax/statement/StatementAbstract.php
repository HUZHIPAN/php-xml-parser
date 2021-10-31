<?php


namespace xml\parser\syntax\statement;


use xml\parser\common\ArrayPeekIterator;
use xml\parser\lexer\Token;
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

    public abstract function run();

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
        $token = $this->getIterator()->next();
        if ($token->getType() !== $tokenType) {
            throw new SyntaxException('syntax error. unexpected：' . $token->getValue);
        }
        return $token->getValue;
    }

    public function getIterator()
    {
        return $this->it;
    }


}