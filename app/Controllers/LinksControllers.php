<?php

class LinksControllers
{
    public function index()
    {
        $db = Database::getInstance();
        $title = 'Proyectos';
        $links = $db->query('SELECT * FROM links ORDER BY id DESC')->get();
        require __DIR__ . '/../../resources/links.template.php';
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación de enlaces
        $title = 'Registrar Proyecto';
        require __DIR__ . '/../../resources/links_create.template.php';
    }

    public function store()
    {
        $db = Database::getInstance();

        $validators = new Validator($_POST, [
            'title' => 'required|min:3|max:190',
            'url' => 'required|url|max:190',
            'description' => 'required|min:3|max:500'
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
            $errors = $validators->errors();
            $title = 'Registrar Proyecto';
            require __DIR__ . '/../../resources/links_create.template.php';
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
        $title = 'Editar Proyecto';
        $db = Database::getInstance();

        $link = $db->query(
            'SELECT * FROM links WHERE id = :id',
            ['id' => $_GET['id']]
        )->firstOrFail();
        
        require __DIR__ . '/../../resources/links_edit.template.php';
    }
}
