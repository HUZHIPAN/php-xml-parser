<?php

namespace xml\parser\lexer;

/**
 * @notice: XML构成元组类型
 *
 * @author HUZHIPAN <huzhipan@lwops.cn>
 * @time 2021/10/30 10:22
 */
class TokenType
{
    const TAG_BEGIN_SYMBOL   = 1;  // 标签开始符号
    const TAG_NAME_TOKEN     = 2;  // 标签头名称标识
    const ATTRIBUTE_NAME     = 3;  // 标签属性名称标识
    const ASSIGN_OPERATOR    = 4;  // 赋值操作符号
    const STRING_VALUE       = 5;  // 字符串值（不区分单双引号)
    const TAG_END_SYMBOL     = 6;  // 单条标签语句结尾（>）
    const TAG_OVER_SYMBOL    = 7;  // 标签结束符号(/)兼容单标签
    const TAG_TEXT_CONTENT   = 8;  // 标签text值
    const TAG_COMMAND_SYMBOL = 9;  // 声明指令标签（?）
    const ANNOTATION_CONTENT = 10; // 注释内容

}