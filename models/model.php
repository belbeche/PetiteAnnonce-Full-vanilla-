<?php
session_start();

function getPdo()
{
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=hotel;charset=utf8',
            'root',
            '',
            array(
                // PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,

            )
        );
        // echo 'connexion ok';
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    return $db;
}

function getAnnonces()
{
    $db = getPdo();
    $reqs = $db->prepare("SELECT * FROM chambres ORDER BY id DESC");
    $reqs->execute();

    return $reqs;
}

function getAnnonce($annonceId)
{
    $db = getPdo();
    $posts = $db->prepare("SELECT * FROM chambres WHERE id = ?");
    $posts->execute(array($annonceId));

    $result = $posts->fetch();
    // var_dump($result);
    // die();
    return $result;
}
