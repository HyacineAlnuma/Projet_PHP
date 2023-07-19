<?php

namespace App\Controllers;

use App\Entity\Database;
use App\Repository\PostRepository;

class AddPostController extends Controller
{
    public function execute($inputs)
    {
        $connection = new Database();

        $postRepository = new PostRepository();
        $postRepository->connection = $connection;
        $postRepository->addPost($inputs);

        header("Location: index.php?action=posts");
    }
}