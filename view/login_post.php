<?php
session_start();
if (isset($_POST['username']) && isset($_POST['pwd'])) {
    $db = getPdo();
    $params = array($_POST['username'], $_POST['pwd']);
    // on vérifie que les données du formulaire sont présentes 
    $req = "SELECT * from users WHERE username=? and pwd=?";
    $res = $db->prepare($req);

    $login = $_POST['username'];
    $password = $_POST['pwd'];
    $res->execute(array($login, $password));
    $result = $res->fetch();
    if ($res->rowCount() === 1) {
        // l'utilisateur existe dans la table
        // on ajoute ses infos en tant que variables de session
        $_SESSION['userID'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['pwd'] = $password;
        // cette variable indique que l'authentification a réussi
        $authOK = true;
    }
}

if (isset($authOK)) {
    echo "<p>Vous avez été reconnu(e) en tant que " . $login . "</p>";
    echo '<a href="/">Poursuivre vers la page d\'accueil</a>';
} else {
    echo "<p>Vous n'avez pas été reconnu(e)</p>";
}
