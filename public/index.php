<?php


require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomepageController;
use App\Controllers\AdministrationController;

use App\Controllers\Post\PostController;
use App\Controllers\Post\PostsController;
use App\Controllers\Post\AddPostController;
use App\Controllers\Post\UpdatePostController;
use App\Controllers\Post\DeletePostController;

use App\Controllers\Comment\ApproveCommentController;
use App\Controllers\Comment\DeleteCommentController;

use App\Controllers\Auth\SigninController;

use App\Entity\Post;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__.'/../templates');
$twig = new Environment($loader, [
        'cache' => false,
        'debug' => true,
    ]);

$twig->addExtension(new \Twig\Extension\DebugExtension());

try {
    if (!isset($_GET['action']) || ($_GET['action'] == '')) {
        (new HomepageController($twig))->execute();
        exit;
    }

    if (($_GET['action']) === 'post' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        $postController = new PostController($twig);
        $postController->execute($id);
    }

    if (($_GET['action']) === 'posts') {
        $postsController = new PostsController($twig);
        $postsController->execute();
    }

    if (($_GET['action']) === 'addPost') {
        (new AddPostController($twig))->execute();
    }

    if (($_GET['action']) === 'updatePost' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        (new UpdatePostController($twig))->execute($id);
    }

    if (($_GET['action']) === 'deletePost' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        (new DeletePostController($twig))->execute($id);
    }

    if (($_GET['action']) === 'contact') {
        (new HomepageController($twig))->sendEmail($_POST);
    }

    if (($_GET['action']) === 'signin') {
        (new SigninController($twig))->execute();
    }

    if (($_GET['action']) === 'administration') {
        (new AdministrationController($twig))->execute();
    }

    if (($_GET['action']) === 'approveComment' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        (new ApproveCommentController($twig))->execute($id);
    }

    if (($_GET['action']) === 'deleteComment' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        (new DeleteCommentController($twig))->execute($id);
    }


    // if (isset($_GET['action']) && ($_GET['action'] !== '')) {
    //     if (($_GET['action']) === 'post') {
    //         if(isset($_GET['id']) && $_GET['id'] > 0) {
    //             $id = $_GET['id'];
    //             $postController = new PostController($twig);
    //             $postController->execute($id);
    //         } else {
    //             throw new Exception('Aucun identifiant de post envoyé');
    //         }
    //     } elseif (($_GET['action']) === 'posts') {
    //         $postsController = new PostsController($twig);
    //         $postsController->execute();
    //     } elseif (($_GET['action']) === 'addPost') {
    //         (new AddPostController($twig))->execute();
    //     } elseif (($_GET['action']) === 'updatePost') {
    //         if(isset($_GET['id']) && $_GET['id'] > 0) {
    //             $id = $_GET['id'];
    //             (new UpdatePostController($twig))->execute($id);
    //         } else {
    //             throw new Exception('Aucun identifiant de post envoyé');
    //         }
    //     } elseif (($_GET['action']) === 'deletePost') {
    //         if(isset($_GET['id']) && $_GET['id'] > 0) {
    //             $id = $_GET['id'];
    //             (new DeletePostController($twig))->execute($id);
    //         } else {
    //             throw new Exception('Aucun identifiant de post envoyé');
    //         }
    //     } elseif (($_GET['action']) === 'contact') {
    //         if (!$_POST) {
    //             // header("Location: index.php");
    //         } else {
    //             (new HomepageController($twig))->sendEmail($_POST);
    //         }
    //     } elseif (($_GET['action']) === 'signin') {
    //         (new SigninController($twig))->execute();
    //     } elseif (($_GET['action']) === 'administration') {
    //         (new AdministrationController($twig))->execute();
    //     } elseif (($_GET['action']) === 'approveComment') {
    //         if(isset($_GET['id']) && $_GET['id'] > 0) {
    //             $id = $_GET['id'];
    //             (new ApproveCommentController($twig))->execute($id);
    //         }
    //     } elseif (($_GET['action']) === 'deleteComment') {
    //         if(isset($_GET['id']) && $_GET['id'] > 0) {
    //             $id = $_GET['id'];
    //             (new DeleteCommentController($twig))->execute($id);
    //         }
    //     }
    // } else {
    //     (new HomepageController($twig))->execute();
    // }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
}
