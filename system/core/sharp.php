<?php

/**
 * Class Shark
 */
class Sharp {

    /**
     * 参数转化为字符串
     * @param $arr
     * @return string
     */
    static function formatArrToParamStr($arr){
        $str="";
        foreach($arr as $key=>$v){
            $str.="&$key=$v";
        }
        return $str;
    }

}


