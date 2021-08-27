<?php

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

function getAnnonces()
{
    return true;
}

function getAnnonce($annonceId)
{
    $db = getPdo();
    $req = $db->prepare('SELECT id, title, content,picture_ads, DATE_FORMAT(created_at, \'%d/%m/%Y à %Hh%i\') as date_creation_fr FROM posts WHERE id = ?');
    $req->execute(array($annonceId));
    $post = $req->fetch();

    return $post;
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

    if (isset($_POST)) {
        $req = $db->prepare("INSERT INTO (title,content,picture_ads) VALUES (:title, :content, :picture_ads)");
        $req->bindParam(':title', $titre);
        $req->bindParam(':content', $content);
        $req->bindParam(':picture_ads', $picture_ads);
        $req->execute();
        $stmt = $req;
    }

    return $stmt;
}
