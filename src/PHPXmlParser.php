<?php

namespace xml\parser;

use xml\parser\lexer\Lexer;
use xml\parser\parser\Parser;
use xml\parser\syntax\SyntaxException;

/**
 * @notice: 提供调用接口
 * @package xml\parser
 *
 * @author HUZHIPAN <huzhipan@lwops.cn>
 * @time 2021/10/31 17:54
 */
class PHPXmlParser
{

    /**
     * Notice: 解析xml为节点树
     * @param $xmlBody
     * @return struct\Node
     *
     * Author: huzhipan
     * Time: 2021/10/31 18:03
     */
    public static function parseXmlToObject($xmlBody)
    {
        try {
            $tokens = Lexer::makeTokenTuple($xmlBody);
            $context = Parser::parse($tokens);
            return $context->getRootNode();
        } catch (\Throwable $exception) {
            return null;
//            throw new SyntaxException($exception->getMessage());
        }
    }

    // TODO
    public static function parseXmlToArray()
    {

    }

    // TODO
    public static function parseXmlString()
    {

    }

    // TODO
    public static function parseXmlFile($filepath, $options = [])
    {

    }

}