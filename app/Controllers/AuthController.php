<?php

namespace App\Controllers;
use Framework\Authenticate;
use Framework\Validator;

class AuthController{
    public function login(){
        //
        view('login.template.php');
    }

    public function authenticate(){
        Validator::make($_POST,[
            'email' => 'required|email',
            'password' => 'required|min:8|max:30',
        ]);

            $login = (new Authenticate())->login(
                $_POST['email'],
                $_POST['password']
            );

            if($login){
                redirect('/');
            }
    }

    public function logout(){
        (new Authenticate())->logout();
        redirect('/login');
    }
}