<?php
session_start();

function getPdo()
{
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=myapp;charset=utf8',
            'root',
            '',
            array(
                // PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
            )

        );
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    return $db;
}

function getConnection($login, $password)
{
    // récupération de l'utilisateur depuis la BDD
    $db = getPdo();
    $req = $db->prepare("SELECT * from users WHERE username = ? and pwd = ?");
    $req->execute(array($login, $password));

    // $password = $_POST['password'];

    // if ($user) {
    //     // on verifie le mot de passe 
    //     $verif = password_verify($password, $user->password);
    //     if ($verif) {
    //         // si c'est bon, on retourne les info de l'utilisateur
    //         return $user;
    //     }
    // }
    // return false;
}

function login($login, $password)
{
    $db = getPdo();
    $params = array($login, $password);
    // on vérifie que les données du formulaire sont présentes 
    $req = "SELECT * from users WHERE username=? and pwd=?";
    $res = $db->prepare($req);
    $res->execute($params);
    $result = $res->fetch();
    if ($res->rowCount() === 1) {
        // l'utilisateur existe dans la table
        // on ajoute ses infos en tant que variables de session
        $_SESSION['userID'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['pwd'] = $result['pwd'];
        // cette variable indique que l'authentification a réussi
        $authOK = true;
        if ($authOK == true) {
            echo "<p>Vous avez été reconnu(e) en tant que " . $_SESSION['username'] . "</p>";
            echo '<a href="/">Poursuivre vers la page d\'accueil</a>';
        } else {
            echo "<p>Vous n'avez pas été reconnu(e)</p>";
        }
        exit();
    }
}




function getAnnonces()
{
    $db = getPdo();
    $reqs = $db->prepare("SELECT * FROM posts INNER JOIN users ON user_id = users.id ORDER BY posts.id DESC");
    $reqs->execute();
    // if ($reqs->rowCount() == 1) {
    //     $posts = $reqs->fetch();
    // } elseif ($reqs->rowCount() > 1) {
    //     $posts = $reqs->fetchAll();
    // } else {
    //     $posts = "";
    // }

    return $posts = $reqs;
}

function getAnnonce($annonceId)
{
    $db = getPdo();
    $posts = $db->prepare("SELECT * FROM posts WHERE user_id = ?");
    $posts->execute(array($annonceId));

    $result = $posts->fetch();
    // var_dump($result);
    // die();
    return $result;
}

function getComments($annonceId)
{
    $db = getPdo();
    $comments = $db->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY comment_date DESC");
    $comments->execute(array($annonceId));

    return $comments;
}

function getCreate()
{
    $db = getPdo();

    $titre = null;
    if (!empty($_POST['title'])) {
        $titre = $_POST['title'];
    }

    $content = null;
    if (!empty($_POST['content'])) {
        $content = htmlspecialchars($_POST['content']);
    }

    //    var_dump($titre, $content);  //fonctionnel

    if (isset($_FILES['picture_ads']) /*and $_FILES['picture_ads']['error'] == 0*/) {
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['picture_ads']['size'] <= 1000000) {
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['picture_ads']['tmp_name']);
            $extension_upload = explode('/', $_FILES['picture_ads']['type']);
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            $name = $_FILES['picture_ads']['name'];
            $extension = '';
            foreach ($extension_upload as $check) {
                if (in_array($check, $extensions_autorisees));
                $extension = $check;
            }
            //var_dump($extension); //fonctionnel
            if (!empty($extension)) {
                $db = getPdo();
                $req = $db->prepare('INSERT INTO posts (title,content,picture_ads,user_id) VALUES (?, ?, ?, ?) ');
                $req->execute([$titre, $content, $name, $_SESSION['userID']]);
                // On peut valider le fichier et le stocker définitivement
                move_uploaded_file($_FILES['picture_ads']['tmp_name'], './uploads/' . $_FILES['picture_ads']['name']);
                // if ($_POST) {
                //     var_dump($_POST);
                //     die();
                // }
                //var_dump($req->execute([$titre, $content, $_FILES['picture_ads']['name'], $_SESSION['userID']])); //bool true
                header('Location: /');
            }
        } else {
            echo 'La taille du fichier est supérieur à la limit autorisée';
        }
        if (!empty($_FILES['name'])) {
        }
    }
}
