<?php


namespace xml\parser\parser;


use xml\parser\common\ArrayPeekIterator;
use xml\parser\lexer\Token;
use xml\parser\lexer\TokenType;
use xml\parser\struct\Node;

class Parser
{

    /**
     * Notice: 解析元组为节点树
     * @param array $tokens 词法分析得到的结果
     * @return Node XML树根节点
     *
     * Author: huzhipan
     * Time: 2021/10/30 18:10
     */
    public static function parse(array $tokens)
    {
        $rootNode = null;
        $it = new ArrayPeekIterator($tokens);

        $node = null;
        while ($it->hasNext()) {
            $token = $it->next();
            if ($token->getType() === TokenType::TAG_BEGIN_SYMBOL) {
                $token = $it->next();
                $node = new Node($token->getValue());
                if ($rootNode === null) {
                    $rootNode = $node;
                }

            }
        }


        return $rootNode;
    }


    /**
     * Notice: 解析单行代码 (一对<>符号中间为一行代码)
     * @param $tokens
     *
     * Author: huzhipan
     * Time: 2021/10/30 19:52
     */
    private static function parseRowCode($tokens)
    {

    }


    private static function parseNode()
    {

    }
}