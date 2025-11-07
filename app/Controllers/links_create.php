<?php

$title = 'Registrar Proyecto';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $url = $_POST['url'] ?? '';
    $description = $_POST['description'] ?? '';

    $errors = [];

    if(empty($title)) {
        $errors[] = 'El título es obligatorio.';
    }
    if(empty($url)) {
        $errors[] = 'La URL es obligatoria.';
    }else if(!filter_var($url, FILTER_VALIDATE_URL)) {
        $errors[] = 'La URL no es válida.';
    }
    if(empty($description)) {
        $errors[] = 'La descripción es obligatoria.';
    }

    if(empty($errors)) {
        $db->query(
            'INSERT INTO links (title, url, description) VALUES (:title, :url, :description)',
            [
                'title' => $title,
                'url' => $url,
                'description' => $description
            ]
        );

        header('Location: /links');
        exit;
    }
 
}
require __DIR__ . '/../../resources/links_create.template.php';