<?php

namespace sys\core;

use \sys\lib\Field as Field;
use \app\models\User as User;


class Form
{
    public $name;
    public $className;
    public $methodName;
    public $actionPath;
    public $enctype;
    public $fields;
    

    public function generate()
    {
        echo "<form action='$this->actionPath'
                method='$this->methodName'
                id='$this->name'
                class='$this->className'";
                
                if ($this->name === 'signing_up_form') {
                    
                    echo ' onsubmit="return false"';
                }
        echo '>';

        if (is_array($this->fields) && count($this->fields) > 0) {
            
            foreach ($this->fields as $field) {
                
                if ($field instanceof Field) {
                    
                    echo '<label>'
                            . ucfirst($field->name)
                        . '</label>';
                        $field->generate();
                        echo '<div class="alert-danger"'
                        . ' id="' . $field->name . '-error">'
                        . '</div>'
                    ;
                }
            }
        }
        echo        "<div class='mt-2'>
                        <input type='submit'
                            name='submit'
                            id='submit'
                            value='Submit'
                            class='btn btn-outline-danger'>
                        <input type='reset'
                            name='reset'
                            value='Reset'
                            class='btn btn-outline-danger'>
                    </div>
            </form>";
    }

    
    public function fill()
    {
        if (is_array($this->fields) && count($this->fields) > 0) {
            
            foreach ($this->fields as $record) {
                
                if (isset($_POST[$record->name])) {
                    
                    $record->fieldValue = $_POST[$record->name];
                }
            }
        }
    }
}
