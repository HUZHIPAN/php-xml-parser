<?php


include_once __DIR__ . '/../vendor/autoload.php';

use xml\parser\PHPXmlParser;
use xml\parser\struct\Node;


$xmlBody = file_get_contents(__DIR__ . '/XmlDemo.xml');

// 解析xml代码为对象
$node = PHPXmlParser::parseXmlToObject($xmlBody);