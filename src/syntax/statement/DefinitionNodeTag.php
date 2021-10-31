<?php


namespace xml\parser\syntax\statement;


use xml\parser\common\ArrayPeekIterator;
use xml\parser\lexer\Token;
use xml\parser\lexer\TokenType;
use xml\parser\parser\Context;
use xml\parser\struct\Node;
use xml\parser\syntax\SyntaxException;

class DefinitionNodeTag extends StatementAbstract
{
    private $isContainNodeEnd = false;
    private $node;


    /**
     * Notice: 执行创建标签节点
     * @param Context $context
     * @return void
     *
     * Author: huzhipan
     * Time: 2021/10/31 0:07
     * @throws SyntaxException
     */
    public function run(Context $context)
    {
        $it = $this->getIterator();
        $this->consume(TokenType::TAG_BEGIN_SYMBOL);
        $nodeName = $this->consume(TokenType::TAG_NAME_TOKEN);
        $node     = new Node($nodeName);

        $attributeTokens = [];
        while ($it->hasNext() &&
            $it->peek()->getType() !== TokenType::TAG_END_SYMBOL &&
            $it->peek()->getType() !== TokenType::TAG_OVER_SYMBOL) {
            $attributeTokens[] = $it->next();
        }


        if ($it->hasNext() && $it->peek()->getType() === TokenType::TAG_OVER_SYMBOL) {
            $this->isContainNodeEnd = true;
            $this->consume(TokenType::TAG_OVER_SYMBOL);
        }

        $attributeHandle = new DefinitionAttribute($attributeTokens);
        $attributeNodes  = $attributeHandle->run($context);
        $node->addAttributeBatch($attributeNodes);

        $this->consume(TokenType::TAG_END_SYMBOL);
        if ($it->hasNext()) {
            $textValue = $this->consume(TokenType::TAG_TEXT_CONTENT);
            $node->setText($textValue);
        }

        $this->node = $node;
        $this->relevantContent($context);
    }

    /**
     * Notice: 将解析的节点关联到上下文
     * @param Context $context
     *
     * Author: huzhipan
     * Time: 2021/10/31 15:28
     * @throws SyntaxException
     */
    public function relevantContent(Context $context)
    {
        $context->mountNode($this->node);
        if ($this->isContainNodeEnd()) {
            $context->finishNodeByName($this->node->getName());
        }
    }

    /**
     * Notice: 是否包含结束标签符号（兼容单标签）
     * @return bool
     *
     * Author: huzhipan
     * Time: 2021/10/31 0:06
     */
    public function isContainNodeEnd()
    {
        return $this->isContainNodeEnd;
    }


}