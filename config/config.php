<?php
/**
 * 系统配置文件
 * @copyright   Copyright(c) 2018
 * @author      wangwei <yuansir@live.cn/yuansir-web.com>
 * @version     1.0
 */

$CONFIG=[

    'system'=>[

        'db'=>[
            'db_host'           =>      'localhost',
            'db_user'           =>      'root',
            'db_password'       =>      'root',
            'db_database'       =>      'db_shgjtx',
            'db_table_prefix'   =>      'tab_',
            'db_charset'        =>      'urf8',
            'db_conn'           =>      '',             //数据库连接标识; pconn 为长久链接，默认为即时链接
        ],

        'db_table'  =>[
            'create_time'       =>'create_time',       //数据表的创建时间字段
            'update_time'       =>'update_time',       //数据表的更新时间字段
        ],


        'lib'=>[
            'prefix'            =>      'my'   //自定义类库的文件前缀
        ],

        /*url_type 定义URL的形式  1 为普通模式    index.php?controller=controller&action=action&id=2
                        2 为PATHINFO   index.php/controller/action/id/2(暂时不实现)*/
        'route'=>[
            'default_controller'             =>      'Home',  //系统默认控制器
            'default_action'                 =>      'index',  //系统默认控制器
            'url_type'                       =>      1
        ],

        'cache'=>[
            'cache_dir'                 =>      'cache', //缓存路径，相对于根目录
            'cache_prefix'              =>      'cache_',//缓存文件名前缀
            'cache_time'                =>      1800,    //缓存时间默认1800秒
            'cache_mode'                =>      2,       //mode 1 为serialize ，model 2为保存为可执行文件
        ],


        'SERVER_TIMEZONE'=>'PRC',      //设置系统时区

        'debug' =>true                 //设置的bug模式


    ],

    'base_url'=>"http://115.29.55.209:8888/",  //项目基础地址

    'request_method' => 'http' ,               //系统协议
];







