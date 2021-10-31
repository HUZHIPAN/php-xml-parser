<?php


namespace xml\parser\syntax\statement;


use xml\parser\lexer\Token;
use xml\parser\lexer\TokenType;
use xml\parser\parser\Context;
use xml\parser\syntax\SyntaxException;

class FinishNodeTag extends StatementAbstract
{

    /**
     * Notice: 标签结束语句
     *
     * Author: huzhipan
     * Time: 2021/10/31 13:13
     * @param Context $context
     * @throws SyntaxException
     */
    public function run(Context $context)
    {
        $this->consume(TokenType::TAG_BEGIN_SYMBOL);
        $this->consume(TokenType::TAG_OVER_SYMBOL);
        $endNodeName = $this->consume(TokenType::TAG_NAME_TOKEN);
        while ($this->getIterator()->peek()->getType() !== TokenType::TAG_END_SYMBOL) {
            $this->getIterator()->next(); // 无意义语段
        }
        $this->consume(TokenType::TAG_END_SYMBOL);
        $context->finishNodeByName($endNodeName);
    }
}