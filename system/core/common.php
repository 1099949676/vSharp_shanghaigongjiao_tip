<?php
/**
 * Created by kite wang.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 17:19
 */
function C($name=null, $value=null) {
    //静态全局变量，后面的使用取值都是在 $)config数组取
    static $_config = array();
    // 无参数时获取所有
    if (empty($name))   return $_config;
    // 优先执行设置获取或赋值
    if (is_string($name)) {
        if (!strpos($name, '.')) {
            $name = strtolower($name);
            if (is_null($value))
                return isset($_config[$name]) ? $_config[$name] : null;
            $_config[$name] = $value;
            return;
        }
        // 二维数组设置和获取支持
        $name = explode('.', $name);
        $name[0]   =  strtolower($name[0]);
        if (is_null($value))
            return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : null;
        $_config[$name[0]][$name[1]] = $value;
        return;
    }
    // include 'config.php' 返回的是一个数组，这个数组作为C函数的参数，所以会跳到这里，然后将数组的值返回给 $_config
    if (is_array($name)){
        return $_config = array_merge($_config, array_change_key_case($name));
    }
    return null; // 避免非法参数
}
