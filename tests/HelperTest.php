<?php

include_once __DIR__ . '/../vendor/autoload.php';

use xml\parser\common\AlphabetHelper;


$result = AlphabetHelper::isConstituteToken('c');
$result = AlphabetHelper::isConstituteToken('a');
$result = AlphabetHelper::isConstituteToken('Z');
$result = AlphabetHelper::isConstituteToken('&');
$result = AlphabetHelper::isConstituteToken('0');
$result = AlphabetHelper::isConstituteToken('1');
$result = AlphabetHelper::isConstituteToken('-');
$result = AlphabetHelper::isConstituteToken(':');
$result = AlphabetHelper::isConstituteToken('%');

