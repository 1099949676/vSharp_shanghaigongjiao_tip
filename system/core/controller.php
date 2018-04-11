<?php
/**
 * 核心控制器
 * @copyright   Copyright(c) 2011
 * @author      yuansir <yuansir@live.cn/yuansir-web.com>
 * @version     1.0
 */
class Controller{

        public $controller=null;

        public function __construct() {
            $controller=get_class($this);
            $this->controller=str_replace("Controller","",$controller);
            header('Content-type:text/html;chartset=utf-8');
        }
        /**
         * 实例化模型
         * @access      final   protected
         * @param       string  $model  模型名称
         */
        final protected function model($model) {
                if (empty($model)) {
                        trigger_error('不能实例化空模型');
                }
                $model_name = $model . 'Model';
                return new $model_name;
        }
        /**
         * 加载类库
         * @param string $lib   类库名称
         * @param Bool  $my     如果FALSE默认加载系统自动加载的类库，如果为TRUE则加载非自动加载类库
         * @return type 
         */
        final protected function load($lib,$auto = TRUE){
                if(empty($lib)){
                        trigger_error('加载类库名不能为空');
                }elseif($auto === TRUE){
                        return Application::$_lib[$lib]; 
                }elseif($auto === FALSE){
                        return  Application::newLib($lib);
                }
        }
        /**
         * 加载系统配置,默认为系统配置 $CONFIG['system'][$config]
         * @access      final   protected
         * @param       string  $config 配置名  
         */
        final   protected function config($config){
                return Application::$_config[$config];
        }
        /**
         * 加载模板文件
         * @access      final   protect
         * @param       string  $path   模板路径
         * @return      string  模板字符串
         */
        final protected function showTemplate($path,$data = array()){
                $template =  $this->load('template');
                $template->init($path,$data);
                $template->outPut();
        }

        /**
         * 加载模板文件
         * @access      final   protect
         * @param       string  $path   模板路径
         * @return      string  模板字符串
         */
        final protected  function display($path,$data = array()){
            $template=$this->load("template");
            $template->init($path,$data);
            $template->outPut();
        }

        /**
         * @param $header 请求头部
         * @param $data   请求主体
         * @param $url    请求地址
         * @param null $storeCookieFile  存储cookie到这个位置
         * @param null $useCookieFile    使用这个位置的cookie
         * @param null $otherUseCookieFile 其他的补充cookie
         * @return int|mixed
         */
        final protected  function curl_post($header,$data,$url,$storeCookieFile=null,$useCookieFile=null,$otherUseCookieFile=null){

            $ch = curl_init();
            if($storeCookieFile){
                //存储cookieFile
                curl_setopt($ch, CURLOPT_COOKIEJAR,  $storeCookieFile);
            }
            if($useCookieFile){
                curl_setopt($ch, CURLOPT_COOKIEFILE, $useCookieFile);
            }
            $res= curl_setopt ($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt ($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
            $result = curl_exec ($ch);
            curl_close($ch);
            if ($result == NULL) {
                return 0;
            }
            return $result;
        }


        /**
         * @param $url  请求的url
         * @param null $header  请求的头部
         * @param null $storeCookieFile 存储cookie到这个位置
         * @param null $useCookieFile   使用这个位置的cookie
         * @return mixed
         */
        final  protected function curl_get($url,$header=null,$storeCookieFile=null,$useCookieFile=null){
            $curl = curl_init(); // 启动一个CURL会话
            if($header){
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            }
            if($storeCookieFile){
                //存储cookieFile
                curl_setopt($curl, CURLOPT_COOKIEJAR,  $storeCookieFile);

            }
            if($useCookieFile){
                curl_setopt($curl, CURLOPT_COOKIEFILE, $useCookieFile);
            }
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 跳过证书检查
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);  // 从证书中检查SSL加密算法是否存在
            $tmpInfo = curl_exec($curl);     //返回api的json对象
            curl_close($curl);
            return $tmpInfo;
        }


        /**
         * 获取页面 url
         * @param $controller
         * @param $action
         * @param $param
         */
        final function genUrl($action,$param=array(),$controller=null){
            $controller = $controller ? $controller:$this->controller;
            return C('request_method')."://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?controller='.$controller.'&action='.$action.Sharp::formatArrToParamStr($param);;
        }

        /*
         * 合并参数获取
         */
        final function input(){
            return array_merge($_GET,$_POST);
        }

}


