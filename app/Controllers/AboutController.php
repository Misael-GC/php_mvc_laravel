<?php

namespace App\Controllers;


class AboutController
{
    public function index()
    {
        $title = 'Sobre mí';
        require BASE_PATH . '/resources/about.template.php';
    }
}
