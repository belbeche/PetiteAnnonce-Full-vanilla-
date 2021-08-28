<?php

require_once('model/model.php');

/**
 * Connexion des utilisateurs
 */
function connection($login, $pswd)
{
    login($login, $pswd);
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
