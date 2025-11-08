<?php

namespace App\Controllers;
use Framework\Database;
use Framework\Validator;


class LinksControllers
{
    public function index()
    {
        $db = Database::getInstance();
        $links = $db->query('SELECT * FROM links ORDER BY id DESC')->get();
        view('links.template.php', ['title' => 'Proyectos', 'links' => $links]);
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación de enlaces
        view('links_create.template.php', ['title' => 'Registrar Proyecto']);
    }

    public function store()
    {
        $db = Database::getInstance();

        $validators = new Validator($_POST, [
            'title' => 'required|min:3|max:190',
            'url' => 'required|url|max:190',
            'description' => 'required|min:10|max:500'
        ]);

        $errors = [];

        if ($validators->passes()) {
            $db->query(
                'INSERT INTO links (title, url, description) VALUES (:title, :url, :description)',
                [
                    'title' => $_POST['title'],
                    'url' => $_POST['url'],
                    'description' => $_POST['description']
                ]
            );

            header('Location: /links');
            exit;
        }
            view('links_create.template.php', ['title' => 'Registrar Proyecto', 'errors' => $validators->errors()]);
    }

    public function delete()
    {
        $db = Database::getInstance();

        if (isset($_POST['id'])) {
            $db->query(
                'DELETE FROM links WHERE id = :id',
                ['id' => $_POST['id']]
            );
        }

        header('Location: /links');
        exit;
    }

    public function edit(){
        $db = Database::getInstance();
        $link = $db->query(
            'SELECT * FROM links WHERE id = :id',
            ['id' => $_GET['id']]
        )->firstOrFail();

        view('links_edit.template.php', ['title' => 'Editar Proyecto', 'link' => $link]);
    }

    public function update(){
        $db = Database::getInstance();

        $validators = new Validator($_POST, [
            'title' => 'required|min:3|max:190',
            'url' => 'required|url|max:190',
            'description' => 'required|min:10|max:500'
        ]);

        $errors = [];
        $link = $db->query(
                'SELECT * FROM links WHERE id = :id',
                ['id' => $_GET['id']]
            )->firstOrFail();

        if ($validators->passes()) {
            $db->query(
                'UPDATE links SET title = :title, url = :url, description = :description WHERE id = :id',
                [
                    'title' => $_POST['title'],
                    'url' => $_POST['url'],
                    'description' => $_POST['description'],
                    'id' => $_GET['id']
                ]
            );

            header('Location: /links');
            exit;
        }

            view('links_edit.template.php', ['title' => 'Editar Proyecto', 'errors' => $validators->errors()]);
    }
}
