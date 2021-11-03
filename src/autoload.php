<?php


/**
 * 当前包的自动加载
 */
spl_autoload_register(function ($class) {

    $realPath = str_replace('xml\\parser\\', '', $class);

    // PSR-4 lookup
    $logicalPathPsr4 = strtr($realPath, '\\', DIRECTORY_SEPARATOR) . '.php';

    $filepath = __DIR__ . DIRECTORY_SEPARATOR . $logicalPathPsr4;

    if (file_exists($filepath)) {
        include_once $filepath;
        return true;
    }
    return null;

}, true, false);