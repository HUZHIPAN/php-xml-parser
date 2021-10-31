<?php

include_once __DIR__ . '/../vendor/autoload.php';

use xml\parser\common\StringPeekIterator;

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

