<?php

include(dirname(dirname(__FILE__)).'/system/lib/phpMailer/Mail.php');

class BaseController extends Controller {

    /**
     * @param array $paramStr 检验参数不能为空 GET 和 POST
     */
    public function verifyNotEmpty($paramStr,$param=array()){

        //结果提示字段
        $resultStr='';

        //获取请求过来的参数
        $param = $param?$param:$this->input();

        //需要校验的参数组装成数组
        $needCheckParamArr=explode(",",$paramStr);

        if($needCheckParamArr){

            foreach($needCheckParamArr as $key=>$v){

                //如果存在非空
                if(!$param[$v]){

                    $resultStr .= $v."不能为空 ";

                }

            }

        }

        if($resultStr){

            echo $resultStr;
            exit;

        }

    }

}

