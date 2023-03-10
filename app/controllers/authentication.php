<?php

namespace app\controllers;

use \sys\core\Controller as Controller;
use \sys\core\View as View;

use \app\models\User as User;
use \sys\lib\Mailsender as Mailsender;

use \app\forms\SigningUpForm as SigningUpForm;
use \app\forms\SigningInForm as SigningInForm;


class Authentication extends Controller
{
    public function __construct()
    {
        parent::__construct(new User());
    }


    public function sign_up()
    {
        $signing_up_form = new SigningUpForm();

        if (empty($_POST['submit'])) {

            return new View('authentication/signingUpView.php', [
                'title' => 'Signing up',
                'form' => $signing_up_form,
                'script' => View::RES . '/js/authentication/signingUpScript.js'
            ]);
        } else {

            $signing_up_form->fill();

            $email = $signing_up_form->fields[3]->fieldValue;

            $this->model->sign_up($signing_up_form->fields[0]->fieldValue
                            , md5($signing_up_form->fields[1]->fieldValue)
                            , $email
                            , date('Y-m-d H:i:s')
                            , 2, 1, 0);

            (new Mailsender($email))->send();


            return new View('authentication/signingData.php', [
                'title' => 'Signing up data',
                'message' => 'You are signed up. Confirmation link was sended.'
            ]);
        }
    }


    public function sign_in()
    {
        $signing_in_form = new SigningInForm();

        if (empty($_POST['submit'])) {

            return new View('authentication/signingInView.php', [
                'title' => 'Signing in',
                'form' => $signing_in_form,
                'script' => View::RES . '/js/authentication/signingInScript.js'
            ]);
        } else {

            $signing_in_form->fill();

            $res = $this->model->sign_in($signing_in_form->fields[0]->fieldValue
                            , md5($signing_in_form->fields[1]->fieldValue));

            if ($res) {

                return new View('authentication/signingData.php', [
                    'title' => 'Signing in data',
                    'message' => 'You are signed in.'
                ]);
            }

            return new View('authentication/signingInView.php', [
                'title' => 'Signing in',
                'form' => $signing_in_form,
                'script' => View::RES . '/js/authentication/signingInScript.js'
            ]);
        }
    }


    public function ajax_check_login()
    {
        if ($this->model->check_login($_POST['login']) === true) {// Pay attention to the return type.

            return 'refused';
        } else {
            
            return 'accepted';
        }
    }


    public function confirm($email)
    {
        $this->model->signing_up_confirm($email);

        return new View('authentication/signingUpConfirmation.php', [
            'title' => 'Confirmation',
            'message' => "$email confirmed"
        ]);
    }
}
