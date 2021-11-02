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
     * @param  string $xmlBody xml数据
     * @return struct\Node
     *
     * Author: huzhipan
     * Time: 2021/10/31 18:03
     */
    public static function parseXmlToObject(string $xmlBody)
    {
        try {
            $tokens = Lexer::makeTokenTuple($xmlBody);
            $context = Parser::parse($tokens);
            return $context->getXmlRoot();
        } catch (\Throwable $exception) {
            return null;
        }
    }


    /**
     * Notice: 解析xml为php数组
     * @param $xmlBody string xml数据
     * @return array
     *
     * Author: huzhipan
     * Time: 2021/11/2 17:28
     */
    public static function parseXmlToArray(string $xmlBody)
    {
        $node = self::parseXmlToObject($xmlBody);
        return $node ? $node->toArray() : [];
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