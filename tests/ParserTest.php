<?php


include_once __DIR__ . '/../vendor/autoload.php';

use xml\parser\PHPXmlParser;
use xml\parser\struct\Node;

/**
 * @params xml（string类型）
 * @return Node
 */






ini_set('display_errors', 'ON');
//ini_set('error_reporting', 'ALL');







$xmlBody = file_get_contents(__DIR__ . '/../examples/largeXml.xml');


$node = PHPXmlParser::parseXmlToObject($xmlBody);




    $tokens = Lexer::makeTokenTuple($xmlBody);

    $context = \xml\parser\parser\Parser::parse($tokens);




    $aa =2;
