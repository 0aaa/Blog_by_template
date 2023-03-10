<?php

namespace app\forms;

use \sys\core\Form as Form;
use \sys\lib\Field as Field;


class SigningInForm extends Form
{
    public function __construct() {
        
        $this->name = 'signing_in_form';
        $this->className = 'w-50';
        $this->methodName = 'POST';
        $this->actionPath = '#';
        $this->enctype = '';
        
        $this->fields = [
            new Field('login', 'input', '', 'form-control'),
            new Field('password', 'input', 'password', 'form-control')
        ];
    }
}
