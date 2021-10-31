<?php


namespace xml\parser\syntax;


use xml\parser\lexer\TokenType;
use xml\parser\parser\Context;
use xml\parser\syntax\statement\DefinitionNodeTag;
use xml\parser\syntax\statement\FinishNodeTag;

class SemanticAnalyse
{
    const DEFINITION_NODE      = 1; // 声明节点
    const DEFINITION_ATTRIBUTE = 2; // 定义属性
    const FINISH_NODE          = 3; // 节点结束


    /**
     * Notice: 解析执行
     * @param $tokens array 语句词组
     * @param $context Context 执行上下文
     *
     * Author: huzhipan
     * Time: 2021/10/31 14:21
     * @throws SyntaxException
     */
    public static function AnalyseAndExecute(array $tokens, $context)
    {
        $type = SemanticAnalyse::semanticType($tokens);

        switch ($type) {
            case SemanticAnalyse::DEFINITION_NODE:
                (new DefinitionNodeTag($tokens))->run($context);
                break;
            case SemanticAnalyse::FINISH_NODE:
                (new FinishNodeTag($tokens))->run($context);
                break;
        }

    }





    public static function semanticType($tokens)
    {
        // TODO 暂时处理
        if (isset($tokens[1]) && $tokens[1]->getType() === TokenType::TAG_OVER_SYMBOL) {
            return self::FINISH_NODE;
        } else {
            return self::DEFINITION_NODE;
        }
    }

}