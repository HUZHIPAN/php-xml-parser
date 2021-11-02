<?php


namespace xml\parser\parser;


use xml\parser\common\ArrayPeekIterator;
use xml\parser\common\ArrayStack;
use xml\parser\lexer\Token;
use xml\parser\lexer\TokenType;
use xml\parser\struct\Node;
use xml\parser\syntax\SemanticAnalyse;
use xml\parser\syntax\SyntaxException;

class Parser
{

    /**
     * Notice: 解析元组为节点树
     * @param array $tokens 词法分析得到的结果
     * @return Context
     *
     * Author: huzhipan
     * Time: 2021/10/30 18:10
     * @throws SyntaxException
     */
    public static function parse(array $tokens)
    {
        $context = new Context();

        $it = new ArrayPeekIterator($tokens);
        while ($it->hasNext()) {
            $statementTokens = [];
            while ($it->hasNext()) {
                $token = $it->next();
                // 处理xml注释
                if ($token->getType() === TokenType::ANNOTATION_CONTENT) {
                    $context->addAnnotation($token->getValue());
                    continue;
                }
                $statementTokens[] = $token;
                if ($token->getType() === TokenType::TAG_END_SYMBOL) {
                    if ($it->hasNext() && $it->peek()->getType() === TokenType::TAG_TEXT_CONTENT) {
                        $statementTokens[] = $it->next();
                    }
                    break;
                }
            }
            if (!empty($statementTokens)) {
                SemanticAnalyse::AnalyseAndExecute($statementTokens, $context);
            }

        }

        return $context;
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