<?php

namespace App\Controllers;
use Framework\Validator;

class AuthController{
    public function login(){
        //
        view('login.template.php');
    }

    public function authenticate(){
        $validator = new Validator($_POST,[
            'email' => 'required|email',
            'password' => 'required|min:8|max:30',
        ]);

        if($validator->passes()){
            $user = db()->query('SELECT * FROM users WHERE email = :email',
                ['email' => $_POST['email']]
            )->first();

            if($user && password_verify($_POST['password'], $user['password'])){
                $_SESSION['user'] =[
                    'id' => $user['id'],
                    'email' => $user['id'],
                    'name' => $user['name']
                ];
                redirect('/');
            }
        }
        view('login.template.php', [
            'errors' =>$validator->errors(),
        ]);
    }
}