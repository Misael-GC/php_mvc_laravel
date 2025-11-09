<?php

namespace App\Controllers;
use Framework\Validator;


class LinksControllers
{
    public function index()
    {
        $links = db()->query('SELECT * FROM links ORDER BY id DESC')->get();
        view('links.template.php', ['title' => 'Proyectos', 'links' => $links]);
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación de enlaces
        view('links_create.template.php', ['title' => 'Registrar Proyecto']);
    }

    public function store()
    {

        Validator::make($_POST, [
            'title' => 'required|min:3|max:190',
            'url' => 'required|url|max:190',
            'description' => 'required|min:10|max:500'
        ]);

        $errors = [];

            db()->query(
                'INSERT INTO links (title, url, description) VALUES (:title, :url, :description)',
                [
                    'title' => $_POST['title'],
                    'url' => $_POST['url'],
                    'description' => $_POST['description']
                ]
            );

            redirect('/links/create', 'Proyecto registrado correctamente');
    }

    public function delete()
    {
        if (isset($_POST['id'])) {
            db()->query(
                'DELETE FROM links WHERE id = :id',
                ['id' => $_POST['id']]
            );
        }

        redirect('/links');
    }

    public function edit(){
        $link = db()->query(
            'SELECT * FROM links WHERE id = :id',
            ['id' => $_GET['id']]
        )->firstOrFail();

        view('links_edit.template.php', ['title' => 'Editar Proyecto', 'link' => $link]);
    }

    public function update(){
       Validator::make($_POST, [
            'title' => 'required|min:3|max:190',
            'url' => 'required|url|max:190',
            'description' => 'required|min:10|max:500'
        ]);

        $errors = [];
        $link = db()->query(
                'SELECT * FROM links WHERE id = :id',
                ['id' => $_GET['id']]
            )->firstOrFail();

            db()->query(
                'UPDATE links SET title = :title, url = :url, description = :description WHERE id = :id',
                [
                    'title' => $_POST['title'],
                    'url' => $_POST['url'],
                    'description' => $_POST['description'],
                    'id' => $_GET['id']
                ]
            );

            redirect('/links/edit?id=' . $link['id'], 'Proyecto actualizado correctamente');
    }
}
