<?php

namespace app\models;

use \sys\core\Model as Model;


class User extends Model
{
    public function sign_up($login, $password, $email, $reg_date, $role_id, $status_id, $is_confirmed)
    {
        $sqlRequest = 'insert into users
                 (login, password, email, reg_date, role_id, status_id, is_confirmed)
                 values (?, ?, ?, ?, ?, ?, ?)';

        $this->execute_dml_query($sqlRequest, [$login, $password, $email, $reg_date, $role_id, $status_id, $is_confirmed]);
    }


    public function sign_in($login, $password)
    {
        $res = $this->execute_select_query('select role_id from users where login=? and password=?'
                        , [$login, $password]);
        
        return count($res);
    }


    public function check_login($loginToCheck)
    {
        $res = $this->execute_select_query('select login from users where login=?', [$loginToCheck]);

        return (count($res) === 0);
    }


    public function signing_up_confirm($email)
    {
        $this->execute_dml_query('update users set is_confirmed=1 where email=?', [$email]);
    }
}
