<?php

require_once('model/model.php');

/**
 * Connexion des utilisateurs
 */
function connection($login, $password)
{
    // $login = getConnection($login, $password);
    require_once('view/login.php');

    return $login;
}
/**
 * Function logout
 *
 * @return redirect
 */
function logOut()
{
    session_destroy();
    header('Location: /');
    exit();
}
/**
 * on rempli les sessions
 *
 * @param [type] $user
 */
function openSession($user)
{
    $_SESSION["id"] = $user->id;
    $_SESSION["login"] = $user->login;
}
/**
 * J'affiche tout mes articles 
 */
function listPosts()
{
    $posts = getAnnonces();
    require_once('view/listPostsView.php');

    return $posts;
}
/**
 * J'affiche un post avec sont id 
 *
 * @param [type] $idAnnonce
 */
function post($idAnnonce)
{
    $post = getAnnonce($idAnnonce);
    $comments = getComments($idAnnonce);
    $data = array($post, $comments);
    require_once('view/postView.php');

    return $data;
}
/**
 * Création article 
 */
function createAnnonce()
{
    $createAnnonce = getCreate();

    require_once('view/postCreate.php');

    return $createAnnonce;
}

function editAnnonce()
{
    require_once('view/edit.php');
}
