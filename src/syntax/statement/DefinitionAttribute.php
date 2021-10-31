<?php


namespace xml\parser\syntax\statement;


use xml\parser\lexer\TokenType;
use xml\parser\struct\Attribute;
use xml\parser\syntax\SyntaxException;

class DefinitionAttribute extends StatementAbstract
{
    /**
     * Notice: 属性赋值语句执行
     *
     * Author: huzhipan
     * Time: 2021/10/30 23:12
     * @throws SyntaxException
     */
    public function run()
    {
        $it = $this->getIterator();

        $attributeNodes = [];

        while ($it->hasNext()) {
            $attributeName = $this->consume(TokenType::TAG_NAME_TOKEN);
            $this->consume(TokenType::ASSIGN_OPERATOR);
            $attributeValue = $this->consume(TokenType::STRING_VALUE);
            $attributeNodes[] = new Attribute($attributeName, $attributeValue);
        }

        return $attributeNodes;
    }

}