<?php

namespace App\Controllers;


class AboutController
{
    public function index()
    {
        view('about.template.php', ['title' => 'Sobre mí']);
    }
}
