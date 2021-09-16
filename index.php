<?php

require_once('controllers/controller.php');

$url = '';
// j'enleve le / , pour pouvoir acceder à mes differente route avec leurs nom
if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
}

//Si je récupère rien , je renvoi vers la page d'accueil , sinon si j'affiche un post avec ces parametres , sinon une erreur
if ($url == '') {
    Accueil();
} elseif ($url[0] == 'login' && !empty($url[0])) {
    require('./view/login.php');
} elseif ($url[0] == 'post' && !empty($url[1])) {
    $idAnnonce = $url[1];
    post($idAnnonce);
} else {
    echo " Error 404 ";
}
