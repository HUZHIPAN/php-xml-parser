<?php


namespace xml\parser\struct;


use JsonSerializable;

class FormatAbstract implements JsonSerializable
{

    /**
     * Notice: 序列化调用
     * @return array|mixed
     *
     * Author: huzhipan
     * Time: 2021/11/2 16:23
     */
    public function jsonSerialize()
    {
        $data = [];
        foreach ($this as $key => $val) {
            $data[$key] = $val;
        }
        return $data;
    }



}