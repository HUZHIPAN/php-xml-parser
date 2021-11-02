<?php


namespace xml\parser\parser;

use xml\parser\common\ArrayStack;
use xml\parser\struct\Node;
use xml\parser\syntax\SyntaxException;

/**
 * @notice: 执行上下文（状态记录）
 * @package xml\parser\parser
 *
 * @author HUZHIPAN <huzhipan@lwops.cn>
 * @time 2021/10/31 14:24
 */
class Context
{
    private $nodeStack;   // 节点栈
    private $rootNode;    // 根节点
    private $commands;    // 指令和声明
    private $annotations; // XML注释

    public function __construct()
    {
        $this->nodeStack   = new ArrayStack();
        $this->rootNode    = new Node('XML');
        $this->commands    = [];
        $this->annotations = [];
    }

    /**
     * Notice: 获取虚拟根节点（节点树）
     * @return Node
     *
     * Author: huzhipan
     * Time: 2021/10/31 18:01
     */
    public function getRootNode()
    {
        return $this->rootNode;
    }


    /**
     * Notice: 获取解析的xml根节点
     * @return mixed
     *
     * Author: huzhipan
     * Time: 2021/11/2 16:53
     */
    public function getXmlRoot()
    {
        // 屏蔽虚拟根节点
        $rootNode = $this->getRootNode();
        $children = $rootNode->getChildren();
        if (count($children) == 1) {
            return end($children);
        }
        return $rootNode;
    }

    /**
     * Notice: 开始解析一个节点（入栈）
     * @param Node $node
     *
     * Author: huzhipan
     * Time: 2021/10/31 14:53
     */
    public function mountNode(Node $node)
    {
        $nodeStack   = $this->getNodeStack();
        $currentNode = $nodeStack->isEmpty() ? $this->rootNode : $nodeStack->peek();
        $currentNode->addChild($node);
        $nodeStack->push($node);
    }

    /**
     * Notice: 节点解析完成（出栈）
     *
     * Author: huzhipan
     * Time: 2021/10/31 14:55
     * @param $nodeName
     * @throws SyntaxException
     */
    public function finishNodeByName($nodeName)
    {
        $currentNode = $this->getNodeStack()->pop();
        if ($currentNode->getName() !== $nodeName) {
            throw new SyntaxException('语义不明确，意外的 ' . $nodeName);
        }
    }

    /**
     * @return ArrayStack
     */
    public function getNodeStack()
    {
        return $this->nodeStack;
    }

    /**
     * Notice: 指令节点
     * @param Node $node
     *
     * Author: huzhipan
     * Time: 2021/11/2 14:49
     */
    public function addCommandNode(Node $node)
    {
        $this->commands[$node->getName()] = $node;
    }

    /**
     * Notice: 添加一段注释
     * @param string $annotation
     *
     * Author: huzhipan
     * Time: 2021/11/2 14:51
     */
    public function addAnnotation(string $annotation)
    {
        $this->annotations[] = $annotation;
    }

}