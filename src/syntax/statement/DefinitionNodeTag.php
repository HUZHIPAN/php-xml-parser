<?php


namespace xml\parser\syntax\statement;


use xml\parser\common\ArrayPeekIterator;
use xml\parser\lexer\Token;
use xml\parser\lexer\TokenType;
use xml\parser\struct\Node;
use xml\parser\syntax\SyntaxException;

class DefinitionNodeTag extends StatementAbstract
{
    private $isContainNodeEnd = false;


    /**
     * Notice: 执行创建标签节点
     * @return Node
     *
     * Author: huzhipan
     * Time: 2021/10/31 0:07
     * @throws SyntaxException
     */
    public function run()
    {
        $it = $this->getIterator();
        $this->consume(TokenType::TAG_BEGIN_SYMBOL);
        $nodeName = $this->consume(TokenType::TAG_NAME_TOKEN);
        $node = new Node($nodeName);

        $attributeTokens = [];
        while ($it->hasNext() &&
            $it->peek()->getType() !== TokenType::TAG_END_SYMBOL &&
            $it->peek()->getType() !== TokenType::TAG_OVER_SYMBOL) {
            $attributeTokens[] = $it->next();
        }

        if ($it->peek()->getType() === TokenType::TAG_OVER_SYMBOL) {
            $this->isContainNodeEnd = true;
        }

        $attributeHandle = new DefinitionAttribute($attributeTokens);
        $attributeNodes = $attributeHandle->run();
        $node->addAttributeBatch($attributeNodes);

        return $node;
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