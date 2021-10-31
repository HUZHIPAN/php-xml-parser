<?php


namespace xml\parser\lexer;


use xml\parser\common\AlphabetHelper;
use xml\parser\common\StringPeekIterator;

class Lexer
{

    /**
     * Notice: 提取元组（词法分析）
     * @param $string
     * @return array
     *
     * Author: huzhipan
     * Time: 2021/10/30 12:18
     */
    public static function makeTokenTuple($string)
    {
        $tokens = [];

        $it = new StringPeekIterator($string);
        while ($it->hasNext()) {
            $char = $it->next();

            // 空白符
            if (AlphabetHelper::isBlank($char)) {
                continue;
            }

            // 标签结束
            if ($char === '/') {
                $tokens[] = new Token(TokenType::TAG_OVER_SYMBOL, $char);
                continue;
            }

            // 单条描述语句结束符号 （相当于分号）
            if ($char === '>') {
                $tokens[] = new Token(TokenType::TAG_END_SYMBOL, $char);
                continue;
            }

            // 标签开始标识
            if ($char === '<') {
                $tokens[] = new Token(TokenType::TAG_BEGIN_SYMBOL, $char);
                continue;
            }

            // 提取标签对间text值
            if (($it->peekPrev() === '>') && ($char !== '<')) {
                $s = $char;
                while ($it->hasNext() && ($it->peek() !== '<')) {
                    $s .= $it->next();
                }
                $tokens[] = new Token(TokenType::TAG_TEXT_CONTENT, $s);
                continue;
            }

            // 名称标识词组
            if (AlphabetHelper::isConstituteToken($char)) {
                while ($it->hasNext() && AlphabetHelper::isConstituteToken($it->peek())) {
                    $char .= $it->next();
                }
                $tokens[] = new Token(TokenType::TAG_NAME_TOKEN, $char);
                continue;
            }

            // 属性赋值符号
            if ($char === '=') {
                $tokens[] = new Token(TokenType::ASSIGN_OPERATOR, $char);
                continue;
            }

            // 提取标签属性值
            if ($char === '"' || $char === '\'') {
                $s = '';
                while ($it->hasNext()) {
                    if ($it->peek() === $char) {
                        $it->next();
                        $tokens[] = new Token(TokenType::STRING_VALUE, $s);
                        break;
                    } else {
                        $s .= $it->next();
                    }
                }
                continue;
            }

        }

        return $tokens;
    }

}