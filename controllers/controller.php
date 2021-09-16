<?php require('models/model.php');


function Accueil()
{
    $posts = getAnnonces();
    require_once('view/index.php');
}

/**
 * J'affiche un post avec sont id 
 *
 * @param [type] $idAnnonce
 */
function post($idAnnonce)
{
    $post = getAnnonce($idAnnonce);

    require_once('view/postView.php');

    return $post;
}
