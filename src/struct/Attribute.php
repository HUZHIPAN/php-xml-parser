<?php


namespace xml\parser\struct;


/**
 * @notice: 节点属性
 * @package xml\parser\struct
 *
 * @author HUZHIPAN <huzhipan@lwops.cn>
 * @time 2021/10/30 17:50
 */
class Attribute
{
    private $name;  // 属性名
    private $value; // 属性值

    public function __construct($name, $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }


    /**
     * Notice: 获取属性名
     * @return string
     *
     * Author: huzhipan
     * Time: 2021/10/30 17:48
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Notice: 获取属性值
     * @return string
     *
     * Author: huzhipan
     * Time: 2021/10/30 17:48
     */
    public function getValue()
    {
        return $this->value;
    }

}