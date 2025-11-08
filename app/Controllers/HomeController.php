<?php

namespace App\Controllers;
class HomeController
{
    public function index(){
        $posts = db()->query('SELECT * FROM posts ORDER BY id DESC LIMIT 6')->get();

        view('home.template.php', [
            'title' => 'Inicio',
            'posts' => $posts,
        ]);
    }
}