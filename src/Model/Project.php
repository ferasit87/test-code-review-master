<?php

namespace App\Model;

class Project
{
    /**
     * @var array
     */
    public $_data; // bad idea to save all fields model as 1 field array also miss hint
    
    public function __construct($data) //miss hint type argument array
    {
        $this->_data = $data;
    }

    /**
     * @return int
     */
    public function getId() // miss hint return type int
    {
        return (int) $this->_data['id']; // miss checking valuable index with  ??. can call undefined index exception
    }

    /**
     * @return string
     */
    public function toJson() //miss hint return type string
    {
        return json_encode($this->_data);
    }
}
