<?php
namespace App\Controllers;
use Framework\Database;

class PostController
{
    public function show(){
        $db = Database::getInstance();
        $title = 'Proyectos';
        $post = $db->query('SELECT * FROM posts WHERE id = :id', [
            'id' => $_GET['id'] ?? null
        ])->firstOrFail();
        require __DIR__ . '/../../resources/post.template.php';
    }
}