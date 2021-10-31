<?php
include_once __DIR__ . '/../vendor/autoload.php';

use xml\parser\lexer\Lexer;
$str = '胡志攀';


$sss = 'qwerty';
$i = 1;
$a = $sss[$i++];


$s = $str[0];
$resb = \xml\parser\common\AlphabetHelper::isBlank($s);
var_dump($str[0].$str[1].$str[2]);
$xmlBody = file_get_contents(__DIR__ . '/../examples/XmlDemo.xml');
try {
    $tokens = Lexer::makeTokenTuple($xmlBody);
} catch (Throwable $e) {

}



echo '1';