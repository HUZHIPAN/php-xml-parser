<?php

namespace xml\parser\lexer;

/**
 * @notice: 单个元组（词法分析后得到）
 *
 * @author HUZHIPAN <huzhipan@lwops.cn>
 * @time 2021/10/30 10:36
 */
class Token
{
    private $_type;
    private $_value;

    public function __construct($type, $value)
    {
        $this->_type = $type;
        $this->_value = $value;
    }

    /**
     * Notice: 获取元组类型
     * @return mixed
     *
     * Author: huzhipan
     * Time: 2021/10/30 11:53
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Notice: 获取元组值
     * @return mixed
     *
     * Author: huzhipan
     * Time: 2021/10/30 11:53
     */
    public function getValue()
    {
        return $this->_value;
    }

}