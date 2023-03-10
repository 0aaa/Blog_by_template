<?php

namespace sys\lib;


class Field
{
    public $name;
    public $tagName;
    public $type;
    public $class;
    public $value;


    public function __construct($name, $tagName, $type, $class, $value = '')
    {
        $this->name = $name;
        $this->tagName = $tagName;
        $this->type = $type;
        $this->class = $class;
        $this->value = $value;
    }

    
    public function generate()
    {
        if ($this->tagName == 'input') {

            echo "<$this->tagName
                    required
                    type='$this->type'
                    id='$this->name'
                    name='$this->name'
                    value='$this->value'
                    class='$this->class'>";
        }
    }
}
