<?php

ini_set('display_errors', 'ON');

require_once __DIR__ . '/../src/autoload.php';

use \xml\parser\PHPXmlParser;
use xml\parser\struct\Node;


$xmlBody = file_get_contents(__DIR__ . '/test_xml01.xml');

// 解析xml代码为对象
$node = PHPXmlParser::parseXmlToObject($xmlBody);

$toArray = $node->toArray();

$jsonStr = json_encode($node);

$array = json_decode($jsonStr, true);
$object = json_decode($jsonStr);

var_dump($node);