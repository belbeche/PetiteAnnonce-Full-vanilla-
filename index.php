<?php
require_once('controller/controller.php');

$url = '';
// j'enleve le / , pour pouvoir acceder à mes differente route avec leurs nom
if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
}

//Si je récupère rien , je renvoi vers la page d'accueil , sinon si j'affiche un post avec ces parametres , sinon une erreur
if ($url == '') {
    listPosts();
} elseif ($url[0] == 'login' && !empty($url[0])) {
    require('./view/login.php');
} elseif ($url[0] == 'logout' && !empty($url[0])) {
    logOut();
} elseif ($url[0] == 'login_post' && !empty($url[0])) {
    connection($_POST['username'], $_POST['pwd']);
} elseif ($url[0] == 'post' && !empty($url[1])) {
    $idAnnonce = $url[1];
    post($idAnnonce);
} elseif ($url[0] == 'create') {
    createAnnonce();
} elseif ($url[0] == 'admin') {
    editAnnonce();
} else {
    echo " Error 404 ";
}
