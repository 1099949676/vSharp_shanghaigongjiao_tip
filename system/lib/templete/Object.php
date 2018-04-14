<?php
 /**
  * Created by PhpStorm.
  * User: Administrator
  * Date: 2018/4/13
  * Time: 11:06
  */

class Object{

    public function offsetExists($offset)
    {
        return array_key_exists($offset, get_object_vars($this));
    }

    public function offsetUnset($key)
    {
        if (array_key_exists($key, get_object_vars($this)) ) {
            unset($this->{$key});
        }
    }

    public function offsetSet($offset, $value)
    {
        $this->{$offset} = $value;
    }

    public function offsetGet($var)
    {
        return $this->$var;
    }

}