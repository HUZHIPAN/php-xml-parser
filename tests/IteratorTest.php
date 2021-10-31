<?php

include_once __DIR__ . '/../vendor/autoload.php';

use xml\parser\common\StringPeekIterator;


$stack = new \xml\parser\common\ArrayStack();

$stack->push('a');

$stack->push('b');

$stack->pop();

$e = $stack->peek();
$stack->push('c');

$stack->pop();
$stack->peek();
$stack->pop();


$string = 'test-abc-1234-HELLO';

$it = new StringPeekIterator($string);
$res = '';
while ($it->hasNext()) {
    $res .= $it->next();
}
if ($string === $res) {
    echo 'passed';
} else {
    echo 'failure';
}

