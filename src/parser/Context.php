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
    private $nodeStack; // 节点栈
    private $rootNode;  // 根节点

    public function __construct()
    {
        $this->nodeStack = new ArrayStack();
        $this->rootNode = new Node('xml');
    }

    /**
     * Notice: 获取根节点（节点树）
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
     * Notice: 开始解析一个节点（入栈）
     * @param Node $node
     *
     * Author: huzhipan
     * Time: 2021/10/31 14:53
     */
    public function mountNode(Node $node)
    {
        $nodeStack = $this->getNodeStack();
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

}