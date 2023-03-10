<?php

namespace app\controllers;

use \sys\core\View as View;
use \sys\core\Controller as Controller;


class Home extends Controller
{
    public function index()
    {
        return new View('home/index.php', [
            'title' => 'Home'
        ]);
    }


    public function contacts()
    {
        return new View('home/contacts.php', [
            'title' => 'Contacts'
        ]);
    }

    
    public function about()
    {
        return new View('home/about.php', [
            'title' => 'About'
        ]);
    }
}
