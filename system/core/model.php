<?php
/**
 * 核心控制器类
 * @copyright   Copyright(c) 2011
 * @author      yuansir <yuansir@live.cn/yuansir-web.com>
 * @version     1.0
 */
class Model {

    public $db = null;

    public $table_name=null;

    final public function __construct() {
        header('Content-type:text/html;chartset=utf-8');
        $this->db = $this->load('mysql');
        $config_db = $this->config('db');
        $this->setTableName($config_db);
        $this->db->init(
                $config_db['db_host'],
                $config_db['db_user'],
                $config_db['db_password'],
                $config_db['db_database'],
                $config_db['db_conn'],
                $config_db['db_charset']
                );                                            //初始话数据库类
    }

    /**
     * 设置当前数据库的表名
     * @param $config_db
     */
    final public function setTableName($config_db){
        $modelName=get_class($this);//取出当前类名
        $tableName=str_replace("Model","",$modelName);
        $this->table_name=strtolower($config_db['db_table_prefix'].$tableName);//全部转化为小写
    }

    /**
     * 根据表前缀获取表名
     * @access      final   protected
     * @param       string  $table_name    表名
     */
    final protected function table($table_name){
        $config_db = $this->config('db');
        return $config_db['db_table_prefix'].$table_name;
    }
    /**
     * 加载类库
     * @param string $lib   类库名称
     * @param Bool  $my     如果FALSE默认加载系统自动加载的类库，如果为TRUE则加载自定义类库
     * @return type
     */
    final protected function load($lib,$my = FALSE){
        if(empty($lib)){
                trigger_error('加载类库名不能为空');
        }elseif($my === FALSE){
                return Application::$_lib[$lib];
        }elseif($my === TRUE){
                return  Application::newLib($lib);
        }
    }
    /**
     * 加载系统配置,默认为系统配置 $CONFIG['system'][$config]
     * @access      final   protected
     * @param       string  $config 配置名
     */
    final   protected function config($config=''){
        return Application::$_config[$config];
    }

    /**封装方法，获取一行数据
     * @param string $cols 获取哪些字段
     * @param array $filter 获取条件的字段
     * @param null $orderType 通过什么排序
     * @return bool
     */
    public function getRow($cols='*', $filter=array(), $orderType=null){
        $data = $this->getList($cols, $filter, 0, 1, $orderType);
        if($data){
            return $data['0'];
        }else{
            return false;
        }
    }

    /**获取多行数据
     * @param string $cols
     * @param array $filter
     * @param int $offset
     * @param int $limit
     * @param null $orderby
     * @return mixed
     */
    public function getList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderby=null){
        if($orderby)  $sql_order = ' ORDER BY ' . (is_array($orderby) ? implode($orderby,' ') : $orderby);
        $rows = $this->db->getQuery('select '.$cols.' from `'.$this->table_name
            .'` where '.$this->filter($filter) . $sql_order, $limit, $offset);
        return $rows;
    }


    /**
     * 组装条件信息
     * @param $filter
     */
    public function filter($filter){

        $where = array('1');

        foreach($filter as $k=>$v){
            $where[] = ' `'.$k.'` = "'.str_replace('"','\\"',$v).'"';
        }

        return implode(' AND',$where);
    }


    /**
     * 插入一条记录
     * @param $columnName
     * @param $value
     * @param string $url
     * @return mixed
     */
    public function insert($data){
        if(!$data){
            return false;
        }
        $columnName="";
        $value="";
        foreach($data as $key=>$v){
            $columnName.=",".$key;
            $value.=","."'".$v."'";
        }
        $columnName=substr($columnName,1);
        $value=substr($value,1);
        return $this->db->insert($this->table_name,$columnName,$value);
    }

}


