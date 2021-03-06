<?php


namespace xml\parser\struct;



/**
 * @notice: XML元素节点
 * @package xml\parser\struct
 *
 * @author HUZHIPAN <huzhipan@lwops.cn>
 * @time 2021/10/30 17:57
 */
class Node extends FormatAbstract
{
    private $name;               // 节点名称
    private $nodeType;           // 节点类型
    private $attributes = [];    // 节点属性列表
    private $text       = '';    // 节点text值
    private $children   = [];    // 子节点

    // 子节点使用哈希表存放（为false时使用数组，兼容xml多子节点相同名称）
    private $childNodeUseHashMap = true;

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
        if (isset($this->children[$node->getName()])) {
            if (!is_array($this->children[$node->getName()])) {
                $this->children[$node->getName()] = [ $this->children[$node->getName()] ];
            }
            $this->children[$node->getName()][] = $node;
            return;
        }

        $this->children[$node->getName()] = $node;

    }

    /**
     * Notice: 获取子节点
     * @return array
     *
     * Author: huzhipan
     * Time: 2021/11/2 17:00
     */
    public function getChildren()
    {
        return $this->children;
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


    public function toArray()
    {
        return json_decode(json_encode($this), true);
    }

    /**
     * Notice: 序列化接口
     * @return array|mixed
     *
     * Author: huzhipan
     * Time: 2021/11/2 16:38
     */
    public function jsonSerialize()
    {
        $data = [];
        foreach ($this as $key => $val) {
            if ($key == 'nodeType' || $key == 'childNodeUseHashMap') continue;
            $data[$key] = $val;
        }
        return $data;
    }


}