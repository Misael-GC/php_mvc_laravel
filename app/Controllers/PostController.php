<?php
namespace App\Controllers;
use Framework\Database;

class PostController
{
    public function show(){
        $db = Database::getInstance();

        $post = $db->query('SELECT * FROM posts WHERE id = :id', [
            'id' => $_GET['id'] ?? null
        ])->firstOrFail();

        view('post.template.php', [
            'title' => 'Proyectos',
            'post' => $post,
        ]);
    }
}