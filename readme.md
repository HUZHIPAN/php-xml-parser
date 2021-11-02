# Xml-Parser / XML解析器

https://github.com/HUZHIPAN/php-xml-parser.git



**xml-parser是一个基于php实现的xml解析器，不依赖于其他扩展或组件。实现phper友好的调用方式，只需要调用一个函数，即可完成对xml标签的解析**

> ps: 虽然是一次加载到内存中解析，但是性能方面完全不需要太过担心，测试2w行的xml代码解析时间是在1秒内。

## ✨使用方法

* 推荐使用composer进行安装

  ```shell
  composer require huzhipan/php-xml-parser
  ```

* 示例

  ```php
  use xml\parser\PHPXmlParser;
  // 返回Node类实例（节点树）
  $node = PHPXmlParser::parseXmlToObject('<xml></xml>');
  // 返回php数组，按xml层级组装
  $node = PHPXmlParser::parseXmlToArray("<tag></tag>");
  ```

* `examples/` 目录下有调用示例

  

## ⌛️ 实现细节

**词法分析** ->  **语法分析** -> **语义解释** ->  **渲染节点**

1. 将xml字符串的每一位抽象成流单元，迭代不断向后推进
2. 使用有限状态机提取token（标识符）,支持的词组可以查看代码中的TokenType类
3. 对标识符列表进行语法组装，以`<`开始为一条语句的开始，`>`标识一条语句的结束，类似于编程语言中的`;`表示一条语句的结束，中间的文本部分提取为标签的text值
4. 支持的语句有*标签声明*、*属性赋值*、*结束语句*等，即形式良好的XML格式
5. 渲染节点时使用深度优先遍历，即在标签声明语句执行时将节点压栈，标签结束时出栈，后续所有声明都以栈顶节点作为父节点







