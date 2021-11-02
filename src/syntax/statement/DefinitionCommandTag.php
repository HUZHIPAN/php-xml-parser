<?php


namespace xml\parser\syntax\statement;


use xml\parser\lexer\TokenType;
use xml\parser\parser\Context;
use xml\parser\struct\Node;
use xml\parser\syntax\SyntaxException;

class DefinitionCommandTag extends StatementAbstract
{

    /**
     * Notice: 解析指令声明标签
     * @param Context $context
     * @return void
     *
     * Author: huzhipan
     * Time: 2021/11/2 15:00
     * @throws SyntaxException
     */
    public function run(Context $context)
    {
        $this->consume(TokenType::TAG_BEGIN_SYMBOL);
        $this->consume(TokenType::TAG_COMMAND_SYMBOL);
        $tagName = $this->consume(TokenType::TAG_NAME_TOKEN);
        $node = new Node($tagName);

        $it = $this->getIterator();

        $attributeTokens = [];
        while ($it->hasNext() &&
            $it->peek()->getType() !== TokenType::TAG_END_SYMBOL &&
            $it->peek()->getType() !== TokenType::TAG_COMMAND_SYMBOL) {
            $attributeTokens[] = $it->next();
        }

        $this->consume(TokenType::TAG_COMMAND_SYMBOL);

        $attributeHandle = new DefinitionAttribute($attributeTokens);
        $attributeNodes  = $attributeHandle->run($context);
        $node->addAttributeBatch($attributeNodes);
        $this->consume(TokenType::TAG_END_SYMBOL);

        $context->addCommandNode($node);
    }
}