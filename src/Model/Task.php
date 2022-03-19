<?php

namespace App\Model;

class Task implements \JsonSerializable
{
    /**
     * @var array
     */
    private $_data; // like project bad idea to save all fields model as 1 field array
    
    public function __construct($data) // hint argument type array 
    {
        $this->_data = $data;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array // return mixed in interface not array
    {
        return $this->_data;
    }
}
