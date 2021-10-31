<?php


namespace xml\parser\struct;

/**
 * @notice: XML元素节点
 * @package xml\parser\struct
 *
 * @author HUZHIPAN <huzhipan@lwops.cn>
 * @time 2021/10/30 17:57
 */
class Node
{
    private $name;               // 节点名称
    private $nodeType;           // 节点类型
    private $attributes = [];    // 节点属性列表
    private $text       = '';    // 节点text值
    private $children   = [];    // 子节点

    public function __construct($name, $nodeType = null)
    {
        $this->name     = $name;
        $this->nodeType = $nodeType;
    }

    /**
     * Notice: 获取节点名称
     * @return string
     *
     * Author: huzhipan
     * Time: 2021/10/30 17:56
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Notice: 添加子节点
     * @param Node $node
     *
     * Author: huzhipan
     * Time: 2021/10/30 17:55
     */
    public function addChild(Node $node)
    {
        $this->children[$node->getName()] = $node;
    }

    /**
     * Notice: 添加节点属性
     * @param Attribute $attribute
     *
     * Author: huzhipan
     * Time: 2021/10/30 17:56
     */
    public function addAttribute(Attribute $attribute)
    {
        $this->attributes[$attribute->getName()] = $attribute;
    }

    public function addAttributeBatch($attributeNodes)
    {
        foreach ($attributeNodes as $attributeNode) {
            $this->addAttribute($attributeNode);
        }
    }

    /**
     * Notice: 设置节点text值
     *
     * Author: huzhipan
     * Time: 2021/10/30 21:56
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * Notice: 获取节点text值
     * @return string
     *
     * Author: huzhipan
     * Time: 2021/10/30 21:59
     */
    public function getText()
    {
        return $this->text;
    }




}