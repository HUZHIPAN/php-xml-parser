<?php


namespace xml\parser\common;


class AlphabetHelper
{
    /**
     * Notice: 判断字符是否可构成标识名称
     *
     * Author: huzhipan
     * Time: 2021/10/30 11:07
     * @param $char
     * @return bool
     */
    public static function isConstituteToken($char)
    {
        return preg_match('/^[_a-zA-Z0-9\:\$\*\@\-]$/', $char) != false;
    }

    /**
     * Notice: 判断是否空白符（空格、\t \n \r \0 \x0B 等）
     * @param $char
     * @return bool
     *
     * Author: huzhipan
     * Time: 2021/10/30 13:48
     */
    public static function isBlank($char)
    {
        return trim($char) === '';
    }

}