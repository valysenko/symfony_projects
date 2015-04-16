<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 25.03.15
 * Time: 0:45
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Entity;


class EntityForQueries {
    private $data = array();

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
       if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return null;
    }

     public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
         unset($this->data[$name]);
    }


}