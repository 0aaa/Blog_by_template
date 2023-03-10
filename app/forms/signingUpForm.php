<?php

namespace app\forms;

use \sys\core\Form as Form;
use \sys\lib\Field as Field;


class SigningUpForm extends Form
{
    public function __construct() {
        
        $this->name = 'signing_up_form';
        $this->className = 'w-50';
        $this->methodName = 'POST';
        $this->actionPath = '#';
        $this->enctype = '';
        
        $this->fields = [
            new Field('login', 'input', '', 'form-control'),
            new Field('password', 'input', 'password', 'form-control'),
            new Field('password-reiteration', 'input', 'password', 'form-control'),
            new Field('email', 'input', 'email', 'form-control')
        ];
    }
}
